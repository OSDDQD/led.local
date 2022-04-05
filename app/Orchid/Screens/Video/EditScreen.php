<?php

namespace App\Orchid\Screens\Video;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Video;
use App\Orchid\Layouts\Video\EditInfoLayout;
use App\Orchid\Layouts\Video\EditVideoLayout;

class EditScreen extends Screen
{

    public $video;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Video $video): iterable
    {
        return [
            'video' => $video
        ]; 
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление роликом';
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
                ->canSee($this->video->exists),
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
                EditVideoLayout::class              
            ]),
        ];
    }

    /**
     * @param Request $request
     * @param City    $city
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Video $video)
    {
        $request->validate([
            'video.title' => [
                'required',
            ],
            'video.is_active' => [
                'required',
                'boolean'
            ],
            'video.customer_id' => [
                'required',
                Rule::exists('customers', 'id'),
            ],
        ]);

        $video->fill($request->get('video'));

        $video->save();

        Toast::info(__('Video was saved'));

        return redirect()->route('platform.videos');
    }
}
