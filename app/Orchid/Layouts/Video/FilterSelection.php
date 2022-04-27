<?php

namespace App\Orchid\Layouts\Video;

use App\Orchid\Filters\CustomerFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class FilterSelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [
            CustomerFilter::class,
        ];
    }
}
