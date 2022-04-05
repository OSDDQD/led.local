<?php

namespace App\Orchid\Layouts\Display;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use App\Models\Display;

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
    protected $target = 'displays';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Наименование'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('size', __('Размер экрана'))
                ->render(function (Display $display) {
                    return view('columns.size', ['display' => $display]);
                }),

            TD::make('is_active', __('Статус'))
                ->sort()
                ->cantHide()
                ->bool(),

            TD::make('city_id', __('Город'))
                ->sort()
                ->filter(Input::make())
                ->cantHide()
                ->render(function (Display $display) {
                    return $display->city->title;
                }),

            TD::make(__('Действия'))
                ->cantHide()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Display $display) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.displays.edit', $display->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the display is deleted, all of its resources and data will be permanently deleted.'))
                                ->method('remove', [
                                    'id' => $display->id,
                                ]),
                        ]);
                }),
        ];
    }
}
