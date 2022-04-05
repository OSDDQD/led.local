<?php

namespace App\Orchid\Layouts\Display;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Group;

class EditInfoLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = 'Основная информация';

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('display.title')
                ->title('Наименование')
                ->placeholder('Наименование')
                ->required()
                ->help('Укажите название экрана для внутренней идентификации'),

            TextArea::make('display.description')
                ->title('Дополнительная информация')
                ->rows(5),

            Switcher::make('display.is_active')
                ->sendTrueOrFalse()
                ->title('Активно'),

            Group::make([
                Input::make('display.width')
                    ->title('Ширина экрана')
                    ->placeholder('Ширина экрана')
                    ->help('Укажите физическую ширину экрана в сантиметрах'),

                Input::make('display.height')
                    ->title('Высота экрана')
                    ->placeholder('Высота экрана')
                    ->help('Укажите физическую высоту экрана в сантиметрах'),
            ]),

            Group::make([
                Input::make('display.width_px')
                    ->title('Ширина дисплея')
                    ->placeholder('Ширина дисплея')
                    ->help('Укажите ширину дисплея в пикселях'),

                Input::make('display.height_px')
                    ->title('Высота дисплея')
                    ->placeholder('Высота дисплея')
                    ->help('Укажите высоту дисплея в пикселях'),
            ]),
        ];
    }
}
