<?php

namespace App\Repositories;

use App\Models\Inventory;
use InfyOm\Generator\Common\BaseRepository;

class InventoryRepository extends BaseRepository
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
        return Inventory::class;
    }
}
