<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class BuyProduct
 * @package App\Models
 * @version October 25, 2020, 6:14 pm UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 */
class BuyProduct extends Model
{

    public $table = 'buy_product';
    public $timestamps = false;
    
    public $fillable = [
        'buy_id', 'product_id', 'product_quantity', 'product_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'buy_id' => 'integer',
        'product_id' => 'integer',
        'product_quantity' => 'integer',
        'product_price' => 'float',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'buy_id' => 'required',
        'product_id' => 'required',
        'product_quantity' => 'required',
        'product_price' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function buy()
    {
        return $this->belongsTo(\App\Models\Buy::class, 'buy_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Buy::class, 'buy_id', 'id');
    }
}
