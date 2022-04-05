<?php

namespace App\Orchid\Layouts\Customer;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\TextArea;

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
            Input::make('customer.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Наименование заказчика'))
                ->placeholder(__('Наименование заказчика')),

            TextArea::make('customer.description')
                ->title(__('Дополнительная информация'))
                ->rows(5),

            Matrix::make('customer.contacts')
                ->title('Контакты заказчика')
                ->columns([
                    'type',
                    'value'
                ])
                ->fields([
                    'type'  => Select::make()
                        ->options([
                            'email' => 'Email',
                            'phone' => 'Телефон',
                        ]),
                    'value' => Input::make()->type('text'),
                ]),
        ];
    }
}
