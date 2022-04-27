<?php

namespace App\Orchid\Layouts\Order;

use App\Orchid\Filters\ActiveOrdersFilter;
use App\Orchid\Filters\CustomerFilter;
use App\Orchid\Filters\DisplayFilter;
use App\Orchid\Filters\EndFilter;
use App\Orchid\Filters\OrderStatusFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use App\Orchid\Filters\StartFilter;
use App\Orchid\Filters\VideoFilter;

class FilterSelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [
            DisplayFilter::class,
            CustomerFilter::class,
            VideoFilter::class,
            StartFilter::class,
            EndFilter::class,
            ActiveOrdersFilter::class,
            OrderStatusFilter::class,
        ];
    }
}
