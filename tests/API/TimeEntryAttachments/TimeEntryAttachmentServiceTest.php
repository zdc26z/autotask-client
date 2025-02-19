<?php

use Anteris\Autotask\API\TimeEntryAttachments\TimeEntryAttachmentCollection;
use Anteris\Autotask\API\TimeEntryAttachments\TimeEntryAttachmentService;
use Anteris\Autotask\API\TimeEntryAttachments\TimeEntryAttachmentEntity;

use Anteris\Autotask\API\TimeEntryAttachments\TimeEntryAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TimeEntryAttachmentService.
 */
class TimeEntryAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers TimeEntryAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TimeEntryAttachmentService::class,
            $this->client->timeEntryAttachments()
        );
    }

    /**
     * @covers TimeEntryAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->timeEntryAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TimeEntryAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers TimeEntryAttachmentCollection
     */
    public function test_collection_contains_time_entry_attachment_entities()
    {
        $result = $this->client->timeEntryAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TimeEntryAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TimeEntryAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TimeEntryAttachmentQueryBuilder::class,
            $this->client->timeEntryAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TimeEntryAttachmentEntity::class);

        $entity = new TimeEntryAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
