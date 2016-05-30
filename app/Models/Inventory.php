<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Inventory",
 *      required={},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="Nama",
 *          description="Nama",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Jumlah",
 *          description="Jumlah",
 *          type="string"
 *      )
 * )
 */
class Inventory extends Model
{
    use SoftDeletes;

    public $table = 'inventories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'Nama',
        'Jumlah'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'Nama' => 'string',
        'Jumlah' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
