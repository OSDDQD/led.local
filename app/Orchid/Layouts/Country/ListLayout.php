<?php

namespace App\Orchid\Layouts\Country;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use App\Models\Country;

class ListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'countries';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Название'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('cities', __('Городов'))
                ->cantHide()
                ->render(function (Country $country) {
                    return $country->cities->count();
                }),

            TD::make('is_active', __('Статус'))
                ->sort()
                ->cantHide()
                ->bool(),

            TD::make(__('Действия'))
                ->cantHide()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Country $country) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.countries.edit', $country->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the country is deleted, all of its resources and data will be permanently deleted.'))
                                ->method('remove', [
                                    'id' => $country->id,
                                ]),
                        ]);
                }),
        ];
    }
}
