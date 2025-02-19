<?php

use Anteris\Autotask\API\ConfigurationItemNotes\ConfigurationItemNoteCollection;
use Anteris\Autotask\API\ConfigurationItemNotes\ConfigurationItemNoteService;
use Anteris\Autotask\API\ConfigurationItemNotes\ConfigurationItemNoteEntity;

use Anteris\Autotask\API\ConfigurationItemNotes\ConfigurationItemNoteQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemNoteService.
 */
class ConfigurationItemNoteServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemNoteService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemNoteService::class,
            $this->client->configurationItemNotes()
        );
    }

    /**
     * @covers ConfigurationItemNoteService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->configurationItemNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ConfigurationItemNoteCollection::class,
            $result
        );
    }

    /**
     * @covers ConfigurationItemNoteCollection
     */
    public function test_collection_contains_configuration_item_note_entities()
    {
        $result = $this->client->configurationItemNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ConfigurationItemNoteEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ConfigurationItemNoteService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ConfigurationItemNoteQueryBuilder::class,
            $this->client->configurationItemNotes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemNoteEntity::class);

        $entity = new ConfigurationItemNoteEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
