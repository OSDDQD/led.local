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
     * @var string
     */
    protected $template = 'layouts.table';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('№ договора'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Order $order) {
                    return view('columns.order_info', ['order' => $order]);
                }),

            TD::make('display_id', __('Экран'))
                ->sort()
                ->cantHide()
                ->render(function (Order $order) {
                    return view('columns.order_display', ['order' => $order]);
                }),

            TD::make('is_active', __('Период показа'))
                ->render(function (Order $order) {
                    return view('columns.order_period', ['order' => $order]);
                }),

            TD::make('is_active', __('Информация'))
                ->render(function (Order $order) {
                    return view('columns.order_desc', ['order' => $order]);
                }),

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
