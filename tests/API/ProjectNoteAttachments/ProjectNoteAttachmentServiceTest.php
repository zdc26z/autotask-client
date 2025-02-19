<?php

use Anteris\Autotask\API\ProjectNoteAttachments\ProjectNoteAttachmentCollection;
use Anteris\Autotask\API\ProjectNoteAttachments\ProjectNoteAttachmentService;
use Anteris\Autotask\API\ProjectNoteAttachments\ProjectNoteAttachmentEntity;

use Anteris\Autotask\API\ProjectNoteAttachments\ProjectNoteAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ProjectNoteAttachmentService.
 */
class ProjectNoteAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers ProjectNoteAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ProjectNoteAttachmentService::class,
            $this->client->projectNoteAttachments()
        );
    }

    /**
     * @covers ProjectNoteAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->projectNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ProjectNoteAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers ProjectNoteAttachmentCollection
     */
    public function test_collection_contains_project_note_attachment_entities()
    {
        $result = $this->client->projectNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ProjectNoteAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ProjectNoteAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ProjectNoteAttachmentQueryBuilder::class,
            $this->client->projectNoteAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ProjectNoteAttachmentEntity::class);

        $entity = new ProjectNoteAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
