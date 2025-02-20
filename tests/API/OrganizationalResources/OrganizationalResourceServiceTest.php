<?php

use Anteris\Autotask\API\OrganizationalResources\OrganizationalResourceCollection;
use Anteris\Autotask\API\OrganizationalResources\OrganizationalResourceService;
use Anteris\Autotask\API\OrganizationalResources\OrganizationalResourceEntity;

use Anteris\Autotask\API\OrganizationalResources\OrganizationalResourceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for OrganizationalResourceService.
 */
class OrganizationalResourceServiceTest extends AbstractTest
{
    /**
     * @covers OrganizationalResourceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            OrganizationalResourceService::class,
            $this->client->organizationalResources()
        );
    }

    /**
     * @covers OrganizationalResourceService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->organizationalResources()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            OrganizationalResourceCollection::class,
            $result
        );
    }

    /**
     * @covers OrganizationalResourceCollection
     */
    public function test_collection_contains_organizational_resource_entities()
    {
        $result = $this->client->organizationalResources()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                OrganizationalResourceEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers OrganizationalResourceService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            OrganizationalResourceQueryBuilder::class,
            $this->client->organizationalResources()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), OrganizationalResourceEntity::class);

        $entity = new OrganizationalResourceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
