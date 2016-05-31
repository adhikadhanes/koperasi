<?php

namespace App\Repositories;

use App\Models\Barang;
use InfyOm\Generator\Common\BaseRepository;

class BarangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Nama',
        'Jumlah'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Barang::class;
    }
}
