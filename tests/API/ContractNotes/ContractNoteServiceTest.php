<?php

use Anteris\Autotask\API\ContractNotes\ContractNoteCollection;
use Anteris\Autotask\API\ContractNotes\ContractNoteService;
use Anteris\Autotask\API\ContractNotes\ContractNoteEntity;

use Anteris\Autotask\API\ContractNotes\ContractNoteQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractNoteService.
 */
class ContractNoteServiceTest extends AbstractTest
{
    /**
     * @covers ContractNoteService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractNoteService::class,
            $this->client->contractNotes()
        );
    }

    /**
     * @covers ContractNoteService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractNoteCollection::class,
            $result
        );
    }

    /**
     * @covers ContractNoteCollection
     */
    public function test_collection_contains_contract_note_entities()
    {
        $result = $this->client->contractNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractNoteEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractNoteService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractNoteQueryBuilder::class,
            $this->client->contractNotes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractNoteEntity::class);

        $entity = new ContractNoteEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
