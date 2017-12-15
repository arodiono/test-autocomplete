<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models
 */
class City extends Model
{
    /**
     * @var string
     */
    protected $table = 'city';
    /**
     * @var array
     */
    protected $fillable = [
        'place_id',
        'name',
        'latitude',
        'longitude'
    ];

    /**
     * @param $id
     * @return bool
     */
    public static function isExist($id)
    {
        return self::where('place_id', $id)->count() === 1;
    }
}