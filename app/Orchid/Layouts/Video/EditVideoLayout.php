<?php

namespace App\Orchid\Layouts\Video;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Select;

class EditVideoLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = 'Техническая информация';

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('video.duration')
                ->title('Длительность ролика')
                ->placeholder('Длительность ролика')
                ->help('Укажите длительность ролика в секундах'),

            Input::make('video.width')
                ->title('Ширина ролика')
                ->placeholder('Ширина ролика')
                ->help('Укажите ширину ролика в пикселях'),

            Input::make('video.height')
                ->title('Высота ролика')
                ->placeholder('Высота ролика')
                ->help('Укажите высоту ролика в пикселях'),
        ];
    }
}
