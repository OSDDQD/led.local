<?php

namespace App\Orchid\Screens\Order;

use App\Models\Order;
use App\Orchid\Layouts\Order\EditAdditionalLayout;
use App\Orchid\Layouts\Order\EditInfoLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditScreen extends Screen
{
    public $order;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Order $order): iterable
    {
        return [
            'order' => $order
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление заказом';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->order->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::columns([
                EditInfoLayout::class,
                new EditAdditionalLayout($this->order)
            ]),
        ];
    }

    /**
     * @param Request $request
     * @param Order $order
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Order $order)
    {
        $request->validate([
            'order.title' => [
                'required',
            ],
            'order.is_active' => [
                'required',
                'boolean'
            ],
            'order.customer_id' => [
                'required',
                Rule::exists('customers', 'id'),
            ],
            'order.display_id' => [
                Rule::exists('displays', 'id'),
            ],
            'order.video_id' => [
                Rule::exists('videos', 'id'),
            ],
        ]);

        $order->fill($request->get('order'));

        $order->save();

        Toast::info(__('Order was saved'));

        return redirect()->route('platform.orders');
    }
}
