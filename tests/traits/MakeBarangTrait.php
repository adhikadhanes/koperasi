<?php

use Faker\Factory as Faker;
use App\Models\Barang;
use App\Repositories\BarangRepository;

trait MakeBarangTrait
{
    /**
     * Create fake instance of Barang and save it in database
     *
     * @param array $barangFields
     * @return Barang
     */
    public function makeBarang($barangFields = [])
    {
        /** @var BarangRepository $barangRepo */
        $barangRepo = App::make(BarangRepository::class);
        $theme = $this->fakeBarangData($barangFields);
        return $barangRepo->create($theme);
    }

    /**
     * Get fake instance of Barang
     *
     * @param array $barangFields
     * @return Barang
     */
    public function fakeBarang($barangFields = [])
    {
        return new Barang($this->fakeBarangData($barangFields));
    }

    /**
     * Get fake data of Barang
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBarangData($barangFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'Nama' => $fake->word,
            'Jumlah' => $fake->word
        ], $barangFields);
    }
}
