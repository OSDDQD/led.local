<?php

namespace App\Orchid\Layouts\City;

use App\Models\Country;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Select;

class EditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('city.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название города'))
                ->placeholder(__('Название города')),

            Select::make('city.country_id')
                ->fromModel(Country::class, 'title')
                ->required()
                ->title(__('Страна'))
                ->help('Выберите страну, которой принадлежит город'),

            Input::make('position')
                ->help('Укажите позицию города для сортировки')
                ->type('number'),

            Switcher::make('city.is_active')
                ->sendTrueOrFalse()
                ->title('Доступен для выбора'),
        ];
    }
}
