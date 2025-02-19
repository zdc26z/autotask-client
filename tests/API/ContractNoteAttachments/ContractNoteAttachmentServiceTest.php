<?php

use Anteris\Autotask\API\ContractNoteAttachments\ContractNoteAttachmentCollection;
use Anteris\Autotask\API\ContractNoteAttachments\ContractNoteAttachmentService;
use Anteris\Autotask\API\ContractNoteAttachments\ContractNoteAttachmentEntity;

use Anteris\Autotask\API\ContractNoteAttachments\ContractNoteAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractNoteAttachmentService.
 */
class ContractNoteAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers ContractNoteAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractNoteAttachmentService::class,
            $this->client->contractNoteAttachments()
        );
    }

    /**
     * @covers ContractNoteAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractNoteAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers ContractNoteAttachmentCollection
     */
    public function test_collection_contains_contract_note_attachment_entities()
    {
        $result = $this->client->contractNoteAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractNoteAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractNoteAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractNoteAttachmentQueryBuilder::class,
            $this->client->contractNoteAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractNoteAttachmentEntity::class);

        $entity = new ContractNoteAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
