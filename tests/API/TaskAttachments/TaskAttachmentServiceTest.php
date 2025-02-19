<?php

use Anteris\Autotask\API\TaskAttachments\TaskAttachmentCollection;
use Anteris\Autotask\API\TaskAttachments\TaskAttachmentService;
use Anteris\Autotask\API\TaskAttachments\TaskAttachmentEntity;

use Anteris\Autotask\API\TaskAttachments\TaskAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TaskAttachmentService.
 */
class TaskAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers TaskAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TaskAttachmentService::class,
            $this->client->taskAttachments()
        );
    }

    /**
     * @covers TaskAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->taskAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TaskAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers TaskAttachmentCollection
     */
    public function test_collection_contains_task_attachment_entities()
    {
        $result = $this->client->taskAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TaskAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TaskAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TaskAttachmentQueryBuilder::class,
            $this->client->taskAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TaskAttachmentEntity::class);

        $entity = new TaskAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
