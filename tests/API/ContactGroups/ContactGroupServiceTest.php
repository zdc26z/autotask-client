<?php

use Anteris\Autotask\API\ContactGroups\ContactGroupCollection;
use Anteris\Autotask\API\ContactGroups\ContactGroupService;
use Anteris\Autotask\API\ContactGroups\ContactGroupEntity;

use Anteris\Autotask\API\ContactGroups\ContactGroupQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContactGroupService.
 */
class ContactGroupServiceTest extends AbstractTest
{
    /**
     * @covers ContactGroupService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContactGroupService::class,
            $this->client->contactGroups()
        );
    }

    /**
     * @covers ContactGroupService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contactGroups()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContactGroupCollection::class,
            $result
        );
    }

    /**
     * @covers ContactGroupCollection
     */
    public function test_collection_contains_contact_group_entities()
    {
        $result = $this->client->contactGroups()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContactGroupEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContactGroupService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContactGroupQueryBuilder::class,
            $this->client->contactGroups()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContactGroupEntity::class);

        $entity = new ContactGroupEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
