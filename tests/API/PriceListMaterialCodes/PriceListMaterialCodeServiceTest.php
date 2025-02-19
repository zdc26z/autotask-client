<?php

use Anteris\Autotask\API\PriceListMaterialCodes\PriceListMaterialCodeCollection;
use Anteris\Autotask\API\PriceListMaterialCodes\PriceListMaterialCodeService;
use Anteris\Autotask\API\PriceListMaterialCodes\PriceListMaterialCodeEntity;

use Anteris\Autotask\API\PriceListMaterialCodes\PriceListMaterialCodeQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for PriceListMaterialCodeService.
 */
class PriceListMaterialCodeServiceTest extends AbstractTest
{
    /**
     * @covers PriceListMaterialCodeService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            PriceListMaterialCodeService::class,
            $this->client->priceListMaterialCodes()
        );
    }

    /**
     * @covers PriceListMaterialCodeService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->priceListMaterialCodes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            PriceListMaterialCodeCollection::class,
            $result
        );
    }

    /**
     * @covers PriceListMaterialCodeCollection
     */
    public function test_collection_contains_price_list_material_code_entities()
    {
        $result = $this->client->priceListMaterialCodes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                PriceListMaterialCodeEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers PriceListMaterialCodeService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            PriceListMaterialCodeQueryBuilder::class,
            $this->client->priceListMaterialCodes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), PriceListMaterialCodeEntity::class);

        $entity = new PriceListMaterialCodeEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
