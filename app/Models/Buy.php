<?php

namespace App\Models;

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
        'user_id' => 'required',
        'total_value' => 'required',
        'date' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
