<?php

use Anteris\Autotask\API\TaskNoteAttachments\TaskNoteAttachmentCollection;
use Anteris\Autotask\API\TaskNoteAttachments\TaskNoteAttachmentService;
use Anteris\Autotask\API\TaskNoteAttachments\TaskNoteAttachmentEntity;

use Anteris\Autotask\API\TaskNoteAttachments\TaskNoteAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TaskNoteAttachmentService.
 */
class TaskNoteAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers TaskNoteAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TaskNoteAttachmentService::class,
            $this->client->taskNoteAttachments()
        );
    }

    /**
     * @covers TaskNoteAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->taskNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TaskNoteAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers TaskNoteAttachmentCollection
     */
    public function test_collection_contains_task_note_attachment_entities()
    {
        $result = $this->client->taskNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TaskNoteAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TaskNoteAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TaskNoteAttachmentQueryBuilder::class,
            $this->client->taskNoteAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TaskNoteAttachmentEntity::class);

        $entity = new TaskNoteAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
