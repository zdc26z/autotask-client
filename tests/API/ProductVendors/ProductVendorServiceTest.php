<?php

use Anteris\Autotask\API\ProductVendors\ProductVendorCollection;
use Anteris\Autotask\API\ProductVendors\ProductVendorService;
use Anteris\Autotask\API\ProductVendors\ProductVendorEntity;

use Anteris\Autotask\API\ProductVendors\ProductVendorQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ProductVendorService.
 */
class ProductVendorServiceTest extends AbstractTest
{
    /**
     * @covers ProductVendorService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ProductVendorService::class,
            $this->client->productVendors()
        );
    }

    /**
     * @covers ProductVendorService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->productVendors()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ProductVendorCollection::class,
            $result
        );
    }

    /**
     * @covers ProductVendorCollection
     */
    public function test_collection_contains_product_vendor_entities()
    {
        $result = $this->client->productVendors()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ProductVendorEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ProductVendorService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ProductVendorQueryBuilder::class,
            $this->client->productVendors()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ProductVendorEntity::class);

        $entity = new ProductVendorEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
