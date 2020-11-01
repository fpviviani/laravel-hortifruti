<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Cart
 * @package App\Models
 * @version October 25, 2020, 6:14 pm UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 */
class Cart extends Model
{

    public $table = 'carts';
    public $timestamps = false;
    
    public $fillable = [
        'user_id', 'products'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'products' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
