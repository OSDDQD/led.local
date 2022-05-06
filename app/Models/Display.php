<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Display extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    /**
     * @var array
     */ 
    protected $fillable = [
        'title',
        'description',
        'location', 
        'latitude',
        'longitude',
        'width',
        'height',
        'width_px',
        'height_px',
        'city_id',
        'is_active'
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'title',
        'city_id',
        'is_active'
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'title',
        'description',
        'location', 
        'city_id',
        'is_active'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['title_location'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_displays');
    }

    public function activeOrders()
    {
        return $this->belongsToMany(Order::class, 'order_displays')
            // ->join('orders', 'orders.id', 'order_displays.order_id')
            ->where('orders.deal_start_at', '<=', now()->format('Y-m-d'))
            ->where('orders.deal_end_at', '>=', now()->format('Y-m-d'));
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function getTitleLocationAttribute()
    {
        return $this->title . ' - ' . $this?->city?->title;
    }
}
