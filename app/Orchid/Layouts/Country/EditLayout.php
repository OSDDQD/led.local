<?php

namespace App\Orchid\Layouts\Country;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Switcher;

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
            Input::make('country.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название страны'))
                ->placeholder(__('Название страны')),

            Switcher::make('country.is_active')
                ->sendTrueOrFalse()
                ->title('Доступна для выбора')
        ];
    }
}
