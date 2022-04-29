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
            Select::make('order.displays.')
                ->options(Display::orderBy('title')->get()->pluck('title_location', 'id')->toArray())
                ->multiple()
                ->title(__('Экраны'))
                ->help('Выберите экраны, на которых будет показан данный заказ'),

            Group::make([
                Select::make('order.video_id')
                    ->options(Video::orderBy('title')->get()->pluck('title_customer', 'id')->toArray())
                    ->title(__('Видео'))
                    ->help('Выберите видео, которое будет использоваться в данном заказе'),

                Select::make('order.status')
                    ->options(Order::STATUS)
                    ->title('Статус оплаты'),  
            ]),

            Group::make([
                Input::make('order.start_at')
                    ->type('date')
                    ->title('Дата начала оплаченного периода'),

                Input::make('order.end_at')
                    ->type('date')
                    ->title('Дата окончания оплаченного периода'),
            ]),

            Input::make('order.notify_days')
                ->title('Отправка уведомлений')
                ->value(5)
                ->required()
                ->help('Укажите количество дней до окончания заказа, чтобы начать присылать уведомления'),
        ];
    }
}
