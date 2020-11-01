<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;

/**
 * Class Buy
 * @package App\Models
 * @version October 25, 2020, 6:14 pm UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 */
class Buy extends Model
{

    public $table = 'buys';
    



    public $fillable = [
        'user_id', 'total_value', 'date', 'is_delivered'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'is_delivered' => 'boolean',
        'total_value' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    protected $appends = [
        'readable_date',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'buy_product', 'buy_id', 'product_id')->withPivot('id', 'product_quantity');
    }

    /**
     * Get date formatted as d/m/Y | H:i
     *
     * @return string
     */
    public function getReadableDateAttribute()
    {
        return is_null($this->date)? null : Carbon::parse($this->date)->format('d/m/Y | H:i');
    }
}
