<?php

use Anteris\Autotask\API\HolidaySets\HolidaySetCollection;
use Anteris\Autotask\API\HolidaySets\HolidaySetService;
use Anteris\Autotask\API\HolidaySets\HolidaySetEntity;

use Anteris\Autotask\API\HolidaySets\HolidaySetQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for HolidaySetService.
 */
class HolidaySetServiceTest extends AbstractTest
{
    /**
     * @covers HolidaySetService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            HolidaySetService::class,
            $this->client->holidaySets()
        );
    }

    /**
     * @covers HolidaySetService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->holidaySets()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            HolidaySetCollection::class,
            $result
        );
    }

    /**
     * @covers HolidaySetCollection
     */
    public function test_collection_contains_holiday_set_entities()
    {
        $result = $this->client->holidaySets()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                HolidaySetEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers HolidaySetService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            HolidaySetQueryBuilder::class,
            $this->client->holidaySets()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), HolidaySetEntity::class);

        $entity = new HolidaySetEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
