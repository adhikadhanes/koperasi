<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Barang",
 *      required={Nama},
 *      @SWG\Property(
 *          property="Barang_ID",
 *          description="Barang_ID",
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
class Barang extends Model
{
    use SoftDeletes;

    public $table = 'barangs';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'Barang_ID';

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
        'Nama' => 'required'
    ];
}
