<?php

namespace App\Orchid\Layouts\Display;

use App\Orchid\Filters\CityFilter;
use App\Orchid\Filters\IsActiveFilter;
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
            CityFilter::class,
            IsActiveFilter::class
        ];
    }
}
