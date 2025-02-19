<?php

use Anteris\Autotask\API\Companies\CompanyCollection;
use Anteris\Autotask\API\Companies\CompanyService;
use Anteris\Autotask\API\Companies\CompanyEntity;

use Anteris\Autotask\API\Companies\CompanyQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanyService.
 */
class CompanyServiceTest extends AbstractTest
{
    /**
     * @covers CompanyService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanyService::class,
            $this->client->companies()
        );
    }

    /**
     * @covers CompanyService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->companies()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            CompanyCollection::class,
            $result
        );
    }

    /**
     * @covers CompanyCollection
     */
    public function test_collection_contains_company_entities()
    {
        $result = $this->client->companies()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                CompanyEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers CompanyService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            CompanyQueryBuilder::class,
            $this->client->companies()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanyEntity::class);

        $entity = new CompanyEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
