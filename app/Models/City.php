<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class City extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'is_active',
        'country_id',
        'position'
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'title',
        'is_active',
    ];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
