<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BarangApiTest extends TestCase
{
    use MakeBarangTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBarang()
    {
        $barang = $this->fakeBarangData();
        $this->json('POST', '/api/v1/barangs', $barang);

        $this->assertApiResponse($barang);
    }

    /**
     * @test
     */
    public function testReadBarang()
    {
        $barang = $this->makeBarang();
        $this->json('GET', '/api/v1/barangs/'.$barang->id);

        $this->assertApiResponse($barang->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBarang()
    {
        $barang = $this->makeBarang();
        $editedBarang = $this->fakeBarangData();

        $this->json('PUT', '/api/v1/barangs/'.$barang->id, $editedBarang);

        $this->assertApiResponse($editedBarang);
    }

    /**
     * @test
     */
    public function testDeleteBarang()
    {
        $barang = $this->makeBarang();
        $this->json('DELETE', '/api/v1/barangs/'.$barang->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/barangs/'.$barang->id);

        $this->assertResponseStatus(404);
    }
}
