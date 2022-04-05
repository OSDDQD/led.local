<?php

namespace App\Orchid\Screens\Customer;

use Orchid\Screen\Screen;
use App\Models\Customer;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use App\Orchid\Layouts\Customer\EditLayout;

class EditScreen extends Screen
{
    public $customer;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Customer $customer): iterable
    {
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
        return 'Управление заказчиком';
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
                ->canSee($this->customer->exists),
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
            Layout::block([
                EditLayout::class
            ])->title('Информация о заказчике')    
        ];
    }

    /**
     * @param Request $request
     * @param Customer  $customer
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Customer $customer)
    {
        $request->validate([
            'customer.title' => [
                'required',
            ],
        ]);

        $customer->fill($request->get('customer'));

        $customer->save();

        Toast::info(__('Customer was saved'));

        return redirect()->route('platform.customers');
    }
}
