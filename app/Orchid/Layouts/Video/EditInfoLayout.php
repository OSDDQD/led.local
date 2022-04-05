<?php

namespace App\Orchid\Layouts\Video;

use App\Models\Customer;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Select;

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
            Input::make('video.title')
                ->title('Наименование')
                ->placeholder('Наименование')
                ->required()
                ->help('Укажите название ролика'),

            Select::make('video.customer_id')
                ->fromModel(Customer::class, 'title')
                ->title(__('Заказчик'))
                ->required()
                ->help('Выберите заказчика, кому принадлежит ролик'),

            TextArea::make('video.description')
                ->title('Дополнительная информация')
                ->rows(5),

            Switcher::make('video.is_active')
                ->sendTrueOrFalse()
                ->title('Активно'),
        ];
    }
}
