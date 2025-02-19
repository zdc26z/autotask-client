<?php

use Anteris\Autotask\API\ProjectCharges\ProjectChargeCollection;
use Anteris\Autotask\API\ProjectCharges\ProjectChargeService;
use Anteris\Autotask\API\ProjectCharges\ProjectChargeEntity;

use Anteris\Autotask\API\ProjectCharges\ProjectChargeQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ProjectChargeService.
 */
class ProjectChargeServiceTest extends AbstractTest
{
    /**
     * @covers ProjectChargeService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ProjectChargeService::class,
            $this->client->projectCharges()
        );
    }

    /**
     * @covers ProjectChargeService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->projectCharges()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ProjectChargeCollection::class,
            $result
        );
    }

    /**
     * @covers ProjectChargeCollection
     */
    public function test_collection_contains_project_charge_entities()
    {
        $result = $this->client->projectCharges()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ProjectChargeEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ProjectChargeService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ProjectChargeQueryBuilder::class,
            $this->client->projectCharges()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ProjectChargeEntity::class);

        $entity = new ProjectChargeEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
