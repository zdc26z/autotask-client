<?php

use Anteris\Autotask\API\ChecklistLibraries\ChecklistLibraryCollection;
use Anteris\Autotask\API\ChecklistLibraries\ChecklistLibraryService;
use Anteris\Autotask\API\ChecklistLibraries\ChecklistLibraryEntity;

use Anteris\Autotask\API\ChecklistLibraries\ChecklistLibraryQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ChecklistLibraryService.
 */
class ChecklistLibraryServiceTest extends AbstractTest
{
    /**
     * @covers ChecklistLibraryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ChecklistLibraryService::class,
            $this->client->checklistLibraries()
        );
    }

    /**
     * @covers ChecklistLibraryService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->checklistLibraries()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ChecklistLibraryCollection::class,
            $result
        );
    }

    /**
     * @covers ChecklistLibraryCollection
     */
    public function test_collection_contains_checklist_library_entities()
    {
        $result = $this->client->checklistLibraries()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ChecklistLibraryEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ChecklistLibraryService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ChecklistLibraryQueryBuilder::class,
            $this->client->checklistLibraries()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ChecklistLibraryEntity::class);

        $entity = new ChecklistLibraryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
