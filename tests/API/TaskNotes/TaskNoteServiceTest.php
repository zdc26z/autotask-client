<?php

use Anteris\Autotask\API\TaskNotes\TaskNoteCollection;
use Anteris\Autotask\API\TaskNotes\TaskNoteService;
use Anteris\Autotask\API\TaskNotes\TaskNoteEntity;

use Anteris\Autotask\API\TaskNotes\TaskNoteQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TaskNoteService.
 */
class TaskNoteServiceTest extends AbstractTest
{
    /**
     * @covers TaskNoteService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TaskNoteService::class,
            $this->client->taskNotes()
        );
    }

    /**
     * @covers TaskNoteService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->taskNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TaskNoteCollection::class,
            $result
        );
    }

    /**
     * @covers TaskNoteCollection
     */
    public function test_collection_contains_task_note_entities()
    {
        $result = $this->client->taskNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TaskNoteEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TaskNoteService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TaskNoteQueryBuilder::class,
            $this->client->taskNotes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TaskNoteEntity::class);

        $entity = new TaskNoteEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
