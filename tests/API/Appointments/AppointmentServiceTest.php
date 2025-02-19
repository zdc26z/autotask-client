<?php

use Anteris\Autotask\API\Appointments\AppointmentCollection;
use Anteris\Autotask\API\Appointments\AppointmentService;
use Anteris\Autotask\API\Appointments\AppointmentEntity;

use Anteris\Autotask\API\Appointments\AppointmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for AppointmentService.
 */
class AppointmentServiceTest extends AbstractTest
{
    /**
     * @covers AppointmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            AppointmentService::class,
            $this->client->appointments()
        );
    }

    /**
     * @covers AppointmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->appointments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            AppointmentCollection::class,
            $result
        );
    }

    /**
     * @covers AppointmentCollection
     */
    public function test_collection_contains_appointment_entities()
    {
        $result = $this->client->appointments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                AppointmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers AppointmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            AppointmentQueryBuilder::class,
            $this->client->appointments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), AppointmentEntity::class);

        $entity = new AppointmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
