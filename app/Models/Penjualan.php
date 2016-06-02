<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Penjualan",
 *      required={Nama},
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
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="Pembeli",
 *          description="Pembeli",
 *          type="string"
 *      )
 * )
 */
class Penjualan extends Model
{
    use SoftDeletes;

    public $table = 'penjualans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'Nama',
        'Jumlah',
        'Pembeli'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'Nama' => 'string',
        'Jumlah' => 'integer',
        'Pembeli' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Nama' => 'required'
    ];

    public function pembeli()
    {
        return $this->belongsTo('App\User','Pembeli','id');
    }

    public function pembelis()
    {
        return $this->belongsTo('App\Models\User','Pembeli','id');
    }
}
