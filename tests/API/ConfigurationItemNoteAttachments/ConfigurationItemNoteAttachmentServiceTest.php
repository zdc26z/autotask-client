<?php

use Anteris\Autotask\API\ConfigurationItemNoteAttachments\ConfigurationItemNoteAttachmentCollection;
use Anteris\Autotask\API\ConfigurationItemNoteAttachments\ConfigurationItemNoteAttachmentService;
use Anteris\Autotask\API\ConfigurationItemNoteAttachments\ConfigurationItemNoteAttachmentEntity;

use Anteris\Autotask\API\ConfigurationItemNoteAttachments\ConfigurationItemNoteAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemNoteAttachmentService.
 */
class ConfigurationItemNoteAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemNoteAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemNoteAttachmentService::class,
            $this->client->configurationItemNoteAttachments()
        );
    }

    /**
     * @covers ConfigurationItemNoteAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->configurationItemNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ConfigurationItemNoteAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers ConfigurationItemNoteAttachmentCollection
     */
    public function test_collection_contains_configuration_item_note_attachment_entities()
    {
        $result = $this->client->configurationItemNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ConfigurationItemNoteAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ConfigurationItemNoteAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ConfigurationItemNoteAttachmentQueryBuilder::class,
            $this->client->configurationItemNoteAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemNoteAttachmentEntity::class);

        $entity = new ConfigurationItemNoteAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
