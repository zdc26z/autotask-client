<?php

use Anteris\Autotask\API\DocumentConfigurationItemAssociations\DocumentConfigurationItemAssociationCollection;
use Anteris\Autotask\API\DocumentConfigurationItemAssociations\DocumentConfigurationItemAssociationService;
use Anteris\Autotask\API\DocumentConfigurationItemAssociations\DocumentConfigurationItemAssociationEntity;

use Anteris\Autotask\API\DocumentConfigurationItemAssociations\DocumentConfigurationItemAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentConfigurationItemAssociationService.
 */
class DocumentConfigurationItemAssociationServiceTest extends AbstractTest
{
    /**
     * @covers DocumentConfigurationItemAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentConfigurationItemAssociationService::class,
            $this->client->documentConfigurationItemAssociations()
        );
    }

    /**
     * @covers DocumentConfigurationItemAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentConfigurationItemAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentConfigurationItemAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentConfigurationItemAssociationCollection
     */
    public function test_collection_contains_document_configuration_item_association_entities()
    {
        $result = $this->client->documentConfigurationItemAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentConfigurationItemAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentConfigurationItemAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentConfigurationItemAssociationQueryBuilder::class,
            $this->client->documentConfigurationItemAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentConfigurationItemAssociationEntity::class);

        $entity = new DocumentConfigurationItemAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
