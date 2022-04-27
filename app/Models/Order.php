<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Order extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    const ORDER_TYPE = [
        0 => 'Коммерческий',
        1 => 'Бонусный'
    ];
    const STATUS = [
        0 => 'В ожидании оплаты',
        1 => 'Оплачено'
    ];
    const PAYMENT_TYPE = [
        0 => 'За месяц',
        1 => 'Единоразово'
    ];

    /**
     * @var array
     */ 
    protected $fillable = [
        'title',
        'description',
        'start_at', 
        'end_at',
        'notify_days',
        'price',
        'status',
        'order_type',
        'customer_id',
        'video_id',
        'is_active',
        'deal_start_at',
        'deal_end_at',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'title',
        'start_at',
        'end_at',
        'status',
        'order_type',
        'customer_id',
        'video_id',
        'is_active'
    ]; 

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'title',
        'start_at',
        'end_at',
        'status',
        'order_type',
        'payment_type',
        'customer_id',
        'video_id',
        'is_active',
        'deal_start_at',
        'deal_end_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }

    public function displays()
    {
        return $this->belongsToMany(Display::class, 'order_displays');
    }
}
 