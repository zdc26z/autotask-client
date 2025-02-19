<?php

use Anteris\Autotask\API\DocumentCategories\DocumentCategoryCollection;
use Anteris\Autotask\API\DocumentCategories\DocumentCategoryService;
use Anteris\Autotask\API\DocumentCategories\DocumentCategoryEntity;

use Anteris\Autotask\API\DocumentCategories\DocumentCategoryQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentCategoryService.
 */
class DocumentCategoryServiceTest extends AbstractTest
{
    /**
     * @covers DocumentCategoryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentCategoryService::class,
            $this->client->documentCategories()
        );
    }

    /**
     * @covers DocumentCategoryService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentCategories()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentCategoryCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentCategoryCollection
     */
    public function test_collection_contains_document_category_entities()
    {
        $result = $this->client->documentCategories()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentCategoryEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentCategoryService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentCategoryQueryBuilder::class,
            $this->client->documentCategories()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentCategoryEntity::class);

        $entity = new DocumentCategoryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
