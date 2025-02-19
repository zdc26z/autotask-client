<?php

use Anteris\Autotask\API\CompanyNotes\CompanyNoteCollection;
use Anteris\Autotask\API\CompanyNotes\CompanyNoteService;
use Anteris\Autotask\API\CompanyNotes\CompanyNoteEntity;

use Anteris\Autotask\API\CompanyNotes\CompanyNoteQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanyNoteService.
 */
class CompanyNoteServiceTest extends AbstractTest
{
    /**
     * @covers CompanyNoteService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanyNoteService::class,
            $this->client->companyNotes()
        );
    }

    /**
     * @covers CompanyNoteService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->companyNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            CompanyNoteCollection::class,
            $result
        );
    }

    /**
     * @covers CompanyNoteCollection
     */
    public function test_collection_contains_company_note_entities()
    {
        $result = $this->client->companyNotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                CompanyNoteEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers CompanyNoteService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            CompanyNoteQueryBuilder::class,
            $this->client->companyNotes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanyNoteEntity::class);

        $entity = new CompanyNoteEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
