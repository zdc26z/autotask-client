<?php

use Anteris\Autotask\API\ExpenseItems\ExpenseItemCollection;
use Anteris\Autotask\API\ExpenseItems\ExpenseItemService;
use Anteris\Autotask\API\ExpenseItems\ExpenseItemEntity;

use Anteris\Autotask\API\ExpenseItems\ExpenseItemQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ExpenseItemService.
 */
class ExpenseItemServiceTest extends AbstractTest
{
    /**
     * @covers ExpenseItemService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ExpenseItemService::class,
            $this->client->expenseItems()
        );
    }

    /**
     * @covers ExpenseItemService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->expenseItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ExpenseItemCollection::class,
            $result
        );
    }

    /**
     * @covers ExpenseItemCollection
     */
    public function test_collection_contains_expense_item_entities()
    {
        $result = $this->client->expenseItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ExpenseItemEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ExpenseItemService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ExpenseItemQueryBuilder::class,
            $this->client->expenseItems()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ExpenseItemEntity::class);

        $entity = new ExpenseItemEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
