<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Customer extends Model
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
        'contacts'
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'title',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'contacts' => 'array',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'customer_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}
