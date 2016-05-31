<?php

use Faker\Factory as Faker;
use App\Models\Inventory;
use App\Repositories\InventoryRepository;

trait MakeInventoryTrait
{
    /**
     * Create fake instance of Inventory and save it in database
     *
     * @param array $inventoryFields
     * @return Inventory
     */
    public function makeInventory($inventoryFields = [])
    {
        /** @var InventoryRepository $inventoryRepo */
        $inventoryRepo = App::make(InventoryRepository::class);
        $theme = $this->fakeInventoryData($inventoryFields);
        return $inventoryRepo->create($theme);
    }

    /**
     * Get fake instance of Inventory
     *
     * @param array $inventoryFields
     * @return Inventory
     */
    public function fakeInventory($inventoryFields = [])
    {
        return new Inventory($this->fakeInventoryData($inventoryFields));
    }

    /**
     * Get fake data of Inventory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInventoryData($inventoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'Nama' => $fake->word,
            'Jumlah' => $fake->randomDigitNotNull
        ], $inventoryFields);
    }
}
