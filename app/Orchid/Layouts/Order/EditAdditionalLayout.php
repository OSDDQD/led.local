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
            Select::make('order.display_id')
                ->fromModel(Display::class, 'title')
                ->title(__('Экран'))
                ->help('Выберите экран, на котором будет показан данный заказ'),

            Select::make('order.video_id')
                ->fromModel(Video::class, 'title')
                ->title(__('Видео'))
                ->help('Выберите видео, которое будет использоваться в данном заказе'),

            Group::make([
                Input::make('order.start_at')
                    ->type('date')
                    ->title('Дата начала показа'),

                Input::make('order.end_at')
                    ->type('date')
                    ->title('Дата окончания показа'),
            ]),

            Input::make('order.notify_days')
                ->title('Отправка уведомлений')
                ->value(5)
                ->required()
                ->help('Укажите количество дней до окончания заказа, чтобы начать присылать уведомления'),
        ];
    }
}
