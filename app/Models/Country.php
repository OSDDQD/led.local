<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Country extends Model
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

    public function cities()
    {
        return $this->hasMany(City::class)
            ->orderBy('position', 'ASC')
            ->where('is_active', true);
    }
}
