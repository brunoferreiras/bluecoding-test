<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Gif.
 *
 * @package namespace App\Models;
 */
class Gif extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['search', 'endpoint', 'data'];

    protected $casts = [
        'data' => 'array',
    ];
}
