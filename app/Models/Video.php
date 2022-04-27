<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Video extends Model
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
        'customer_id', 
        'width',
        'height',
        'duration',
        'is_active'
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'title',
        'customer_id',
        'is_active'
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'title',
        'customer_id',
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

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'video_id', 'id');
    }
}
 