<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventoryApiTest extends TestCase
{
    use MakeInventoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInventory()
    {
        $inventory = $this->fakeInventoryData();
        $this->json('POST', '/api/v1/inventories', $inventory);

        $this->assertApiResponse($inventory);
    }

    /**
     * @test
     */
    public function testReadInventory()
    {
        $inventory = $this->makeInventory();
        $this->json('GET', '/api/v1/inventories/'.$inventory->id);

        $this->assertApiResponse($inventory->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInventory()
    {
        $inventory = $this->makeInventory();
        $editedInventory = $this->fakeInventoryData();

        $this->json('PUT', '/api/v1/inventories/'.$inventory->id, $editedInventory);

        $this->assertApiResponse($editedInventory);
    }

    /**
     * @test
     */
    public function testDeleteInventory()
    {
        $inventory = $this->makeInventory();
        $this->json('DELETE', '/api/v1/inventories/'.$inventory->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inventories/'.$inventory->id);

        $this->assertResponseStatus(404);
    }
}
