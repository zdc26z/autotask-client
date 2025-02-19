<?php

use Anteris\Autotask\API\DocumentConfigurationItemCategoryAssociations\DocumentConfigurationItemCategoryAssociationCollection;
use Anteris\Autotask\API\DocumentConfigurationItemCategoryAssociations\DocumentConfigurationItemCategoryAssociationService;
use Anteris\Autotask\API\DocumentConfigurationItemCategoryAssociations\DocumentConfigurationItemCategoryAssociationEntity;

use Anteris\Autotask\API\DocumentConfigurationItemCategoryAssociations\DocumentConfigurationItemCategoryAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentConfigurationItemCategoryAssociationService.
 */
class DocumentConfigurationItemCategoryAssociationServiceTest extends AbstractTest
{
    /**
     * @covers DocumentConfigurationItemCategoryAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentConfigurationItemCategoryAssociationService::class,
            $this->client->documentConfigurationItemCategoryAssociations()
        );
    }

    /**
     * @covers DocumentConfigurationItemCategoryAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentConfigurationItemCategoryAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentConfigurationItemCategoryAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentConfigurationItemCategoryAssociationCollection
     */
    public function test_collection_contains_document_configuration_item_category_association_entities()
    {
        $result = $this->client->documentConfigurationItemCategoryAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentConfigurationItemCategoryAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentConfigurationItemCategoryAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentConfigurationItemCategoryAssociationQueryBuilder::class,
            $this->client->documentConfigurationItemCategoryAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentConfigurationItemCategoryAssociationEntity::class);

        $entity = new DocumentConfigurationItemCategoryAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
