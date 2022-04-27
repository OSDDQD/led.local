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

    public function orders()
    {
        return $this->hasMany(Order::class, 'display_id', 'id');
    }

    public function activeOrders()
    {
        return $this->hasMany(Order::class, 'display_id', 'id')->where('end_at', '>', now()->format('Y-m-d'));
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
