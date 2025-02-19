<?php

use Anteris\Autotask\API\ExpenseItemAttachments\ExpenseItemAttachmentCollection;
use Anteris\Autotask\API\ExpenseItemAttachments\ExpenseItemAttachmentService;
use Anteris\Autotask\API\ExpenseItemAttachments\ExpenseItemAttachmentEntity;

use Anteris\Autotask\API\ExpenseItemAttachments\ExpenseItemAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ExpenseItemAttachmentService.
 */
class ExpenseItemAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers ExpenseItemAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ExpenseItemAttachmentService::class,
            $this->client->expenseItemAttachments()
        );
    }

    /**
     * @covers ExpenseItemAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->expenseItemAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ExpenseItemAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers ExpenseItemAttachmentCollection
     */
    public function test_collection_contains_expense_item_attachment_entities()
    {
        $result = $this->client->expenseItemAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ExpenseItemAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ExpenseItemAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ExpenseItemAttachmentQueryBuilder::class,
            $this->client->expenseItemAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ExpenseItemAttachmentEntity::class);

        $entity = new ExpenseItemAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
