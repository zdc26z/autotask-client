<?php

use Anteris\Autotask\API\AttachmentInfo\AttachmentInfoCollection;
use Anteris\Autotask\API\AttachmentInfo\AttachmentInfoService;
use Anteris\Autotask\API\AttachmentInfo\AttachmentInfoEntity;

use Anteris\Autotask\API\AttachmentInfo\AttachmentInfoQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for AttachmentInfoService.
 */
class AttachmentInfoServiceTest extends AbstractTest
{
    /**
     * @covers AttachmentInfoService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            AttachmentInfoService::class,
            $this->client->attachmentInfo()
        );
    }

    /**
     * @covers AttachmentInfoService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->attachmentInfo()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            AttachmentInfoCollection::class,
            $result
        );
    }

    /**
     * @covers AttachmentInfoCollection
     */
    public function test_collection_contains_attachment_info_entities()
    {
        $result = $this->client->attachmentInfo()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                AttachmentInfoEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers AttachmentInfoService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            AttachmentInfoQueryBuilder::class,
            $this->client->attachmentInfo()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), AttachmentInfoEntity::class);

        $entity = new AttachmentInfoEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
