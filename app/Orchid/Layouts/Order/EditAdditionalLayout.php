<?php

namespace App\Orchid\Layouts\Order;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Select;
use App\Models\Customer;
use App\Models\Video;
use App\Models\Display;
use App\Models\Order;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Relation;

class EditAdditionalLayout extends Rows
{
    public $order;

    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = 'Дополнительная информация';

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Relation::make('order.displays.')
                ->fromModel(Display::class, 'title')
                ->displayAppend('title_location')
                // ->options($displays)
                ->empty()
                ->multiple()
                ->title(__('Экраны'))
                ->help('Выберите экраны, на которых будет показан данный заказ'),

            Relation::make('order.video_id')
                ->fromModel(Video::class, 'title')
                ->displayAppend('title_customer')
                ->title(__('Видео'))
                ->help('Выберите видео, которое будет использоваться в данном заказе'),

            Group::make([
                Select::make('order.status')
                    ->options(Order::STATUS)
                    ->title('Статус оплаты'),  

                Select::make('order.payed_for')
                    ->empty()
                    ->options(Order::MONTH_RANGE)
                    ->title('Оплачено до'),
            ]),

            Input::make('order.notify_days')
                ->title('Отправка уведомлений')
                ->value(5)
                ->required()
                ->help('Укажите количество дней до окончания заказа, чтобы начать присылать уведомления'),
        ];
    }
}
