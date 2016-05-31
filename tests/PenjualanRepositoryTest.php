<?php

use App\Models\Penjualan;
use App\Repositories\PenjualanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PenjualanRepositoryTest extends TestCase
{
    use MakePenjualanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PenjualanRepository
     */
    protected $penjualanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->penjualanRepo = App::make(PenjualanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePenjualan()
    {
        $penjualan = $this->fakePenjualanData();
        $createdPenjualan = $this->penjualanRepo->create($penjualan);
        $createdPenjualan = $createdPenjualan->toArray();
        $this->assertArrayHasKey('id', $createdPenjualan);
        $this->assertNotNull($createdPenjualan['id'], 'Created Penjualan must have id specified');
        $this->assertNotNull(Penjualan::find($createdPenjualan['id']), 'Penjualan with given id must be in DB');
        $this->assertModelData($penjualan, $createdPenjualan);
    }

    /**
     * @test read
     */
    public function testReadPenjualan()
    {
        $penjualan = $this->makePenjualan();
        $dbPenjualan = $this->penjualanRepo->find($penjualan->id);
        $dbPenjualan = $dbPenjualan->toArray();
        $this->assertModelData($penjualan->toArray(), $dbPenjualan);
    }

    /**
     * @test update
     */
    public function testUpdatePenjualan()
    {
        $penjualan = $this->makePenjualan();
        $fakePenjualan = $this->fakePenjualanData();
        $updatedPenjualan = $this->penjualanRepo->update($fakePenjualan, $penjualan->id);
        $this->assertModelData($fakePenjualan, $updatedPenjualan->toArray());
        $dbPenjualan = $this->penjualanRepo->find($penjualan->id);
        $this->assertModelData($fakePenjualan, $dbPenjualan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePenjualan()
    {
        $penjualan = $this->makePenjualan();
        $resp = $this->penjualanRepo->delete($penjualan->id);
        $this->assertTrue($resp);
        $this->assertNull(Penjualan::find($penjualan->id), 'Penjualan should not exist in DB');
    }
}
