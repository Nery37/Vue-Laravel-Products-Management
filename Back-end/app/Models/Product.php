<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version April 14, 2020, 11:00 pm UTC
 *
 * @property string license
 * @property string support
 * @property string technology
 * @property number tickets
 * @property integer sales
 * @property number earnings
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'license',
        'support',
        'technology',
        'tickets',
        'sales',
        'earnings'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'license' => 'string',
        'support' => 'string',
        'technology' => 'string',
        'tickets' => 'float',
        'sales' => 'integer',
        'earnings' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'license' => 'required',
        'support' => 'required',
        'technology' => 'required',
        'tickets' => 'required',
        'sales' => 'required',
        'earnings' => 'required'
    ];

    
}
