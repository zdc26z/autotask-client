<?php

use Anteris\Autotask\API\PriceListProductTiers\PriceListProductTierCollection;
use Anteris\Autotask\API\PriceListProductTiers\PriceListProductTierService;
use Anteris\Autotask\API\PriceListProductTiers\PriceListProductTierEntity;

use Anteris\Autotask\API\PriceListProductTiers\PriceListProductTierQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for PriceListProductTierService.
 */
class PriceListProductTierServiceTest extends AbstractTest
{
    /**
     * @covers PriceListProductTierService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            PriceListProductTierService::class,
            $this->client->priceListProductTiers()
        );
    }

    /**
     * @covers PriceListProductTierService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->priceListProductTiers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            PriceListProductTierCollection::class,
            $result
        );
    }

    /**
     * @covers PriceListProductTierCollection
     */
    public function test_collection_contains_price_list_product_tier_entities()
    {
        $result = $this->client->priceListProductTiers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                PriceListProductTierEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers PriceListProductTierService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            PriceListProductTierQueryBuilder::class,
            $this->client->priceListProductTiers()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), PriceListProductTierEntity::class);

        $entity = new PriceListProductTierEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
