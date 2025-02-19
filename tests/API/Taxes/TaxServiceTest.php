<?php

use Anteris\Autotask\API\Taxes\TaxCollection;
use Anteris\Autotask\API\Taxes\TaxService;
use Anteris\Autotask\API\Taxes\TaxEntity;

use Anteris\Autotask\API\Taxes\TaxQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TaxService.
 */
class TaxServiceTest extends AbstractTest
{
    /**
     * @covers TaxService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TaxService::class,
            $this->client->taxes()
        );
    }

    /**
     * @covers TaxService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->taxes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TaxCollection::class,
            $result
        );
    }

    /**
     * @covers TaxCollection
     */
    public function test_collection_contains_tax_entities()
    {
        $result = $this->client->taxes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TaxEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TaxService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TaxQueryBuilder::class,
            $this->client->taxes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TaxEntity::class);

        $entity = new TaxEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
