<?php

namespace App\Orchid\Layouts\Display;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Select;
use App\Models\City;
use Orchid\Screen\Fields\Map;

class EditLocationLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = 'Информация о местоположении'; 

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Select::make('display.city_id')
                ->fromModel(City::class, 'title')
                ->title(__('Город'))
                ->help('Выберите город, где распологается экран'),

            Input::make('display.location')
                ->title('Адрес экрана')
                ->placeholder('Адрес экрана'),

            // Map::make('place')
            //     ->title('Расположение экрана')
            //     ->help('Введите координаты или выберите место на карте'),
                
            Group::make([
                Input::make('display.latitude')
                    ->title('Широта')
                    ->placeholder('Широта')
                    ->help('Укажите широту экрана для отображения на карте'),

                Input::make('display.longitude')
                    ->title('Долгота')
                    ->placeholder('Долгота')
                    ->help('Укажите долготу экрана для отображения на карте'),
            ]),
        ];
    }
}
