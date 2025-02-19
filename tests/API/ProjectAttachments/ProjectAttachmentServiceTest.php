<?php

use Anteris\Autotask\API\ProjectAttachments\ProjectAttachmentCollection;
use Anteris\Autotask\API\ProjectAttachments\ProjectAttachmentService;
use Anteris\Autotask\API\ProjectAttachments\ProjectAttachmentEntity;

use Anteris\Autotask\API\ProjectAttachments\ProjectAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ProjectAttachmentService.
 */
class ProjectAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers ProjectAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ProjectAttachmentService::class,
            $this->client->projectAttachments()
        );
    }

    /**
     * @covers ProjectAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->projectAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ProjectAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers ProjectAttachmentCollection
     */
    public function test_collection_contains_project_attachment_entities()
    {
        $result = $this->client->projectAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ProjectAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ProjectAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ProjectAttachmentQueryBuilder::class,
            $this->client->projectAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ProjectAttachmentEntity::class);

        $entity = new ProjectAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
