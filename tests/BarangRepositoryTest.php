<?php

use App\Models\Barang;
use App\Repositories\BarangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BarangRepositoryTest extends TestCase
{
    use MakeBarangTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BarangRepository
     */
    protected $barangRepo;

    public function setUp()
    {
        parent::setUp();
        $this->barangRepo = App::make(BarangRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBarang()
    {
        $barang = $this->fakeBarangData();
        $createdBarang = $this->barangRepo->create($barang);
        $createdBarang = $createdBarang->toArray();
        $this->assertArrayHasKey('id', $createdBarang);
        $this->assertNotNull($createdBarang['id'], 'Created Barang must have id specified');
        $this->assertNotNull(Barang::find($createdBarang['id']), 'Barang with given id must be in DB');
        $this->assertModelData($barang, $createdBarang);
    }

    /**
     * @test read
     */
    public function testReadBarang()
    {
        $barang = $this->makeBarang();
        $dbBarang = $this->barangRepo->find($barang->id);
        $dbBarang = $dbBarang->toArray();
        $this->assertModelData($barang->toArray(), $dbBarang);
    }

    /**
     * @test update
     */
    public function testUpdateBarang()
    {
        $barang = $this->makeBarang();
        $fakeBarang = $this->fakeBarangData();
        $updatedBarang = $this->barangRepo->update($fakeBarang, $barang->id);
        $this->assertModelData($fakeBarang, $updatedBarang->toArray());
        $dbBarang = $this->barangRepo->find($barang->id);
        $this->assertModelData($fakeBarang, $dbBarang->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBarang()
    {
        $barang = $this->makeBarang();
        $resp = $this->barangRepo->delete($barang->id);
        $this->assertTrue($resp);
        $this->assertNull(Barang::find($barang->id), 'Barang should not exist in DB');
    }
}
