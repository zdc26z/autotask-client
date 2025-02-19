<?php

use Anteris\Autotask\API\ContactBillingProductAssociations\ContactBillingProductAssociationCollection;
use Anteris\Autotask\API\ContactBillingProductAssociations\ContactBillingProductAssociationService;
use Anteris\Autotask\API\ContactBillingProductAssociations\ContactBillingProductAssociationEntity;

use Anteris\Autotask\API\ContactBillingProductAssociations\ContactBillingProductAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContactBillingProductAssociationService.
 */
class ContactBillingProductAssociationServiceTest extends AbstractTest
{
    /**
     * @covers ContactBillingProductAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContactBillingProductAssociationService::class,
            $this->client->contactBillingProductAssociations()
        );
    }

    /**
     * @covers ContactBillingProductAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contactBillingProductAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContactBillingProductAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers ContactBillingProductAssociationCollection
     */
    public function test_collection_contains_contact_billing_product_association_entities()
    {
        $result = $this->client->contactBillingProductAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContactBillingProductAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContactBillingProductAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContactBillingProductAssociationQueryBuilder::class,
            $this->client->contactBillingProductAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContactBillingProductAssociationEntity::class);

        $entity = new ContactBillingProductAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
