<?php

use Anteris\Autotask\API\Contacts\ContactCollection;
use Anteris\Autotask\API\Contacts\ContactService;
use Anteris\Autotask\API\Contacts\ContactEntity;

use Anteris\Autotask\API\Contacts\ContactQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContactService.
 */
class ContactServiceTest extends AbstractTest
{
    /**
     * @covers ContactService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContactService::class,
            $this->client->contacts()
        );
    }

    /**
     * @covers ContactService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contacts()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContactCollection::class,
            $result
        );
    }

    /**
     * @covers ContactCollection
     */
    public function test_collection_contains_contact_entities()
    {
        $result = $this->client->contacts()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContactEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContactService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContactQueryBuilder::class,
            $this->client->contacts()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContactEntity::class);

        $entity = new ContactEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
