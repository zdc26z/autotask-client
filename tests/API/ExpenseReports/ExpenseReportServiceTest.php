<?php

use Anteris\Autotask\API\ExpenseReports\ExpenseReportCollection;
use Anteris\Autotask\API\ExpenseReports\ExpenseReportService;
use Anteris\Autotask\API\ExpenseReports\ExpenseReportEntity;

use Anteris\Autotask\API\ExpenseReports\ExpenseReportQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ExpenseReportService.
 */
class ExpenseReportServiceTest extends AbstractTest
{
    /**
     * @covers ExpenseReportService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ExpenseReportService::class,
            $this->client->expenseReports()
        );
    }

    /**
     * @covers ExpenseReportService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->expenseReports()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ExpenseReportCollection::class,
            $result
        );
    }

    /**
     * @covers ExpenseReportCollection
     */
    public function test_collection_contains_expense_report_entities()
    {
        $result = $this->client->expenseReports()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ExpenseReportEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ExpenseReportService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ExpenseReportQueryBuilder::class,
            $this->client->expenseReports()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ExpenseReportEntity::class);

        $entity = new ExpenseReportEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
