<?php

use Anteris\Autotask\API\ResourceAttachments\ResourceAttachmentCollection;
use Anteris\Autotask\API\ResourceAttachments\ResourceAttachmentService;
use Anteris\Autotask\API\ResourceAttachments\ResourceAttachmentEntity;

use Anteris\Autotask\API\ResourceAttachments\ResourceAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ResourceAttachmentService.
 */
class ResourceAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers ResourceAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ResourceAttachmentService::class,
            $this->client->resourceAttachments()
        );
    }

    /**
     * @covers ResourceAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->resourceAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ResourceAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers ResourceAttachmentCollection
     */
    public function test_collection_contains_resource_attachment_entities()
    {
        $result = $this->client->resourceAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ResourceAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ResourceAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ResourceAttachmentQueryBuilder::class,
            $this->client->resourceAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ResourceAttachmentEntity::class);

        $entity = new ResourceAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
