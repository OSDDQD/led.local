<?php

namespace App\Orchid\Screens\Display;

use App\Models\Display;
use App\Orchid\Layouts\Display\EditInfoLayout;
use App\Orchid\Layouts\Display\EditLocationLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditScreen extends Screen
{

    public $display;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Display $display): iterable
    {
        return [
            'display' => $display
        ]; 
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление экраном';
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
                ->canSee($this->display->exists),
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
                EditLocationLayout::class
            ]),
        ];
    }

    /**
     * @param Request $request
     * @param Display $display
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Display $display)
    {
        $request->validate([
            'display.title' => [
                'required',
            ],
            'display.is_active' => [
                'required',
                'boolean'
            ],
            'display.city_id' => [
                'required',
                Rule::exists('cities', 'id'),
            ],
        ]);

        $display->fill($request->get('display'));

        $display->save();

        Toast::info(__('Display was saved'));

        return redirect()->route('platform.displays');
    }
}
