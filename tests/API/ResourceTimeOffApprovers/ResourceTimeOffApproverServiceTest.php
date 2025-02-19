<?php

use Anteris\Autotask\API\ResourceTimeOffApprovers\ResourceTimeOffApproverCollection;
use Anteris\Autotask\API\ResourceTimeOffApprovers\ResourceTimeOffApproverService;
use Anteris\Autotask\API\ResourceTimeOffApprovers\ResourceTimeOffApproverEntity;

use Anteris\Autotask\API\ResourceTimeOffApprovers\ResourceTimeOffApproverQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ResourceTimeOffApproverService.
 */
class ResourceTimeOffApproverServiceTest extends AbstractTest
{
    /**
     * @covers ResourceTimeOffApproverService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ResourceTimeOffApproverService::class,
            $this->client->resourceTimeOffApprovers()
        );
    }

    /**
     * @covers ResourceTimeOffApproverService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->resourceTimeOffApprovers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ResourceTimeOffApproverCollection::class,
            $result
        );
    }

    /**
     * @covers ResourceTimeOffApproverCollection
     */
    public function test_collection_contains_resource_time_off_approver_entities()
    {
        $result = $this->client->resourceTimeOffApprovers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ResourceTimeOffApproverEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ResourceTimeOffApproverService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ResourceTimeOffApproverQueryBuilder::class,
            $this->client->resourceTimeOffApprovers()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ResourceTimeOffApproverEntity::class);

        $entity = new ResourceTimeOffApproverEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
