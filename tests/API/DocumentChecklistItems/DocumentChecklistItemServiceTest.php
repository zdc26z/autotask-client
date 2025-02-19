<?php

use Anteris\Autotask\API\DocumentChecklistItems\DocumentChecklistItemCollection;
use Anteris\Autotask\API\DocumentChecklistItems\DocumentChecklistItemService;
use Anteris\Autotask\API\DocumentChecklistItems\DocumentChecklistItemEntity;

use Anteris\Autotask\API\DocumentChecklistItems\DocumentChecklistItemQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentChecklistItemService.
 */
class DocumentChecklistItemServiceTest extends AbstractTest
{
    /**
     * @covers DocumentChecklistItemService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentChecklistItemService::class,
            $this->client->documentChecklistItems()
        );
    }

    /**
     * @covers DocumentChecklistItemService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentChecklistItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentChecklistItemCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentChecklistItemCollection
     */
    public function test_collection_contains_document_checklist_item_entities()
    {
        $result = $this->client->documentChecklistItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentChecklistItemEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentChecklistItemService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentChecklistItemQueryBuilder::class,
            $this->client->documentChecklistItems()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentChecklistItemEntity::class);

        $entity = new DocumentChecklistItemEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
