<?php

namespace App\Orchid\Screens\Country;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Country;
use App\Orchid\Layouts\Country\EditLayout;

class EditScreen extends Screen
{

    /**
     * @var Country
     */
    public $country; 

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Country $country): iterable
    {
        return [
            'country' => $country
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление страной';
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
                ->canSee($this->country->exists),
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
            ])->title('Информация о стране')    
        ];
    }

    /**
     * @param Request $request
     * @param Country    $country
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Country $country)
    {
        $request->validate([
            'country.title' => [
                'required',
                Rule::unique(Country::class, 'title')->ignore($country),
            ],
            'country.is_active' => [
                'required',
                'boolean'
            ]
        ]);

        $country->fill($request->get('country'));

        $country->save();

        Toast::info(__('Country was saved'));

        return redirect()->route('platform.countries');
    }
}
