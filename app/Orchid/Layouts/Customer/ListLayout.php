<?php

namespace App\Orchid\Layouts\Customer;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use App\Models\Customer;

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
    protected $target = 'customers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Заказчик'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function(Customer $customer) {
                    return view('columns.customer_title', ['customer' => $customer]);
                }),

            TD::make('contacts', __('Контактная информация'))
                ->render(function(Customer $customer) {
                    return view('columns.customer_contact', ['customer' => $customer]);
                }),

            TD::make('additional', __('Дополнительная информация'))
                ->render(function(Customer $customer) {
                    return view('columns.customer_additional', ['customer' => $customer]);
                }),

            TD::make(__('Действия'))
                ->cantHide()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Customer $customer) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.customers.edit', $customer->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the customer is deleted, all of its resources and data will be permanently deleted.'))
                                ->method('remove', [
                                    'id' => $customer->id,
                                ]),
                        ]);
                }),
        ];
    }
}
