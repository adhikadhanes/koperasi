<?php

use Faker\Factory as Faker;
use App\Models\Penjualan;
use App\Repositories\PenjualanRepository;

trait MakePenjualanTrait
{
    /**
     * Create fake instance of Penjualan and save it in database
     *
     * @param array $penjualanFields
     * @return Penjualan
     */
    public function makePenjualan($penjualanFields = [])
    {
        /** @var PenjualanRepository $penjualanRepo */
        $penjualanRepo = App::make(PenjualanRepository::class);
        $theme = $this->fakePenjualanData($penjualanFields);
        return $penjualanRepo->create($theme);
    }

    /**
     * Get fake instance of Penjualan
     *
     * @param array $penjualanFields
     * @return Penjualan
     */
    public function fakePenjualan($penjualanFields = [])
    {
        return new Penjualan($this->fakePenjualanData($penjualanFields));
    }

    /**
     * Get fake data of Penjualan
     *
     * @param array $postFields
     * @return array
     */
    public function fakePenjualanData($penjualanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'Nama' => $fake->word,
            'Jumlah' => $fake->randomDigitNotNull,
            'Pembeli' => $fake->word
        ], $penjualanFields);
    }
}
