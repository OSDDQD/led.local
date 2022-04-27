<?php

namespace App\Orchid\Layouts\Order;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Select;
use App\Models\Customer;
use App\Models\Order;
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
            Input::make('order.title')
                ->title('Наименование')
                ->placeholder('Наименование')
                ->required()
                ->help('Укажите название для данного заказа'),

            Select::make('order.customer_id')
                ->fromModel(Customer::class, 'title')
                ->title(__('Заказчик'))
                ->required()
                ->help('Выберите заказчика для данного заказа'),

            TextArea::make('order.description')
                ->title('Дополнительная информация')
                ->rows(5),

            Group::make([
                Select::make('order.status')
                ->options(Order::STATUS)
                ->title('Статус оплаты'),  

                Select::make('order.order_type')
                    ->options(Order::ORDER_TYPE)
                    ->title('Тип заказа'),

                Input::make('order.price')
                    ->title('Стоимость')
                    ->placeholder('Стоимость')
            ])->fullWidth(),

            Switcher::make('order.is_active')
                ->sendTrueOrFalse()
                ->value(true)
                ->title('Активно'),
        ];
    }
}
