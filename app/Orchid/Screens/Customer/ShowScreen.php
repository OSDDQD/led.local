<?php

namespace App\Orchid\Screens\Customer;

use Orchid\Screen\Screen;
use App\Models\Customer;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Sight;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ShowScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Customer $customer): iterable
    {
        $customer->load(['orders', 'videos']);

        return [
            'customer' => $customer
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Заказчик';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('customer', [
                Sight::make('title', 'Наименование'),
                Sight::make('description', 'Дополнительно'),
                Sight::make('contacts', 'Контактная информация')
                ->render(function (Customer $customer) {
                    return view('columns.customer_contact', ['customer' => $customer]);
                }),
                Sight::make('orders', 'Заказы')
                ->render(function (Customer $customer) {
                    $url = route('platform.orders', ['customer_id' => $customer->id]);
                    return "<a href='{$url}'>{$customer->orders->count()}</a>";
                }),
            ])->title('Информация'),
        ];
    }
}
