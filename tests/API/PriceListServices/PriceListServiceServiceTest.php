<?php

use Anteris\Autotask\API\PriceListServices\PriceListServiceCollection;
use Anteris\Autotask\API\PriceListServices\PriceListServiceService;
use Anteris\Autotask\API\PriceListServices\PriceListServiceEntity;

use Anteris\Autotask\API\PriceListServices\PriceListServiceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for PriceListServiceService.
 */
class PriceListServiceServiceTest extends AbstractTest
{
    /**
     * @covers PriceListServiceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            PriceListServiceService::class,
            $this->client->priceListServices()
        );
    }

    /**
     * @covers PriceListServiceService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->priceListServices()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            PriceListServiceCollection::class,
            $result
        );
    }

    /**
     * @covers PriceListServiceCollection
     */
    public function test_collection_contains_price_list_service_entities()
    {
        $result = $this->client->priceListServices()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                PriceListServiceEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers PriceListServiceService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            PriceListServiceQueryBuilder::class,
            $this->client->priceListServices()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), PriceListServiceEntity::class);

        $entity = new PriceListServiceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
