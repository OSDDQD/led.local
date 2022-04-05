<?php

namespace App\Orchid\Layouts\Order;

use App\Models\Order;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;

class ListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Наименование'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('display_id', __('Экран'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Order $order) {
                    return $order->display->title;
                }),

            TD::make('customer_id', __('Заказчик'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Order $order) {
                    return $order->customer->title;
                }),

            TD::make('video_id', __('Видео'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Order $order) {
                    return $order->video->title;
                }),

            TD::make('is_active', __('Статус'))
                ->sort()
                ->cantHide()
                ->bool(),

            TD::make(__('Действия'))
                ->cantHide()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Order $order) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.orders.edit', $order->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the order is deleted, all of its resources and data will be permanently deleted.'))
                                ->method('remove', [
                                    'id' => $order->id,
                                ]),
                        ]);
                }),
        ];
    }
}
