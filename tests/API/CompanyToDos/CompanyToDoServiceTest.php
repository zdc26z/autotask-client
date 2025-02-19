<?php

use Anteris\Autotask\API\CompanyToDos\CompanyToDoCollection;
use Anteris\Autotask\API\CompanyToDos\CompanyToDoService;
use Anteris\Autotask\API\CompanyToDos\CompanyToDoEntity;

use Anteris\Autotask\API\CompanyToDos\CompanyToDoQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanyToDoService.
 */
class CompanyToDoServiceTest extends AbstractTest
{
    /**
     * @covers CompanyToDoService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanyToDoService::class,
            $this->client->companyToDos()
        );
    }

    /**
     * @covers CompanyToDoService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->companyToDos()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            CompanyToDoCollection::class,
            $result
        );
    }

    /**
     * @covers CompanyToDoCollection
     */
    public function test_collection_contains_company_to_do_entities()
    {
        $result = $this->client->companyToDos()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                CompanyToDoEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers CompanyToDoService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            CompanyToDoQueryBuilder::class,
            $this->client->companyToDos()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanyToDoEntity::class);

        $entity = new CompanyToDoEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
