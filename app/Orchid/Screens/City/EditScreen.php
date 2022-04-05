<?php

namespace App\Orchid\Screens\City;

use Orchid\Screen\Screen;
use App\Models\City;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Orchid\Layouts\City\EditLayout;
 
class EditScreen extends Screen
{
    /**
     * @var Country
     */
    public $city; 

    /**
     * Query data.
     *
     * @return array
     */
    public function query(City $city): iterable
    {
        return [
            'city' => $city
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление городом';
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
                ->canSee($this->city->exists),
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
            ])->title('Информация о городе')    
        ];
    }

    /**
     * @param Request $request
     * @param City    $city
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, City $city)
    {
        $request->validate([
            'city.title' => [
                'required',
            ],
            'city.is_active' => [
                'required',
                'boolean'
            ],
            'city.country_id' => [
                'required',
                Rule::exists('countries', 'id'),
            ],
            'city.position' => [
                'integer'
            ]
        ]);

        $city->fill($request->get('city'));

        $city->save();

        Toast::info(__('City was saved'));

        return redirect()->route('platform.cities');
    }
}
