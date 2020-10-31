<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Product
 * @package App\Models
 * @version October 25, 2020, 6:18 pm UTC
 *
 */
class Product extends Model
{

    public $table = 'products';
    



    public $fillable = [
        'name', 'price', 'stock', 'photo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'photo' => 'string',
        'price' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'photo' => 'required',
    ];

    /**
     * Get user photo or a default photo
     *
     * @return string
     */
    public function getPhotoAttribute()
    {
        return empty($this->attributes['photo'])? "/images/admin.jpg" : $this->attributes['photo'];
    }

    /**
     * File upload
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')->singleFile();
    }
}
