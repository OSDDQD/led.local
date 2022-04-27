<?php

namespace App\Orchid\Layouts\Video;

use App\Models\Video;
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
    protected $target = 'videos';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Название'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('customer_id', __('Заказчик'))
                ->sort()
                ->cantHide()
                ->render(function (Video $video) {
                    return $video->customer->title;
                }),

            TD::make('info', __('Информация'))
                ->render(function (Video $video) {
                    return view('columns.video_info', ['video' => $video]);
                }),

            TD::make('is_active', __('Статус'))
                ->sort() 
                ->cantHide()
                ->bool(),

            TD::make(__('Действия'))
                ->cantHide()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Video $video) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.videos.edit', $video->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the video is deleted, all of its resources and data will be permanently deleted.'))
                                ->method('remove', [
                                    'id' => $video->id,
                                ]),
                        ]);
                }),
        ];
    }
}
