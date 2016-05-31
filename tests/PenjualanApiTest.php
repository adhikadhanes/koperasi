<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PenjualanApiTest extends TestCase
{
    use MakePenjualanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePenjualan()
    {
        $penjualan = $this->fakePenjualanData();
        $this->json('POST', '/api/v1/penjualans', $penjualan);

        $this->assertApiResponse($penjualan);
    }

    /**
     * @test
     */
    public function testReadPenjualan()
    {
        $penjualan = $this->makePenjualan();
        $this->json('GET', '/api/v1/penjualans/'.$penjualan->id);

        $this->assertApiResponse($penjualan->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePenjualan()
    {
        $penjualan = $this->makePenjualan();
        $editedPenjualan = $this->fakePenjualanData();

        $this->json('PUT', '/api/v1/penjualans/'.$penjualan->id, $editedPenjualan);

        $this->assertApiResponse($editedPenjualan);
    }

    /**
     * @test
     */
    public function testDeletePenjualan()
    {
        $penjualan = $this->makePenjualan();
        $this->json('DELETE', '/api/v1/penjualans/'.$penjualan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/penjualans/'.$penjualan->id);

        $this->assertResponseStatus(404);
    }
}
