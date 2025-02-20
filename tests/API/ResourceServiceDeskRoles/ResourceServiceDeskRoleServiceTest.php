<?php

use Anteris\Autotask\API\ResourceServiceDeskRoles\ResourceServiceDeskRoleCollection;
use Anteris\Autotask\API\ResourceServiceDeskRoles\ResourceServiceDeskRoleService;
use Anteris\Autotask\API\ResourceServiceDeskRoles\ResourceServiceDeskRoleEntity;

use Anteris\Autotask\API\ResourceServiceDeskRoles\ResourceServiceDeskRoleQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ResourceServiceDeskRoleService.
 */
class ResourceServiceDeskRoleServiceTest extends AbstractTest
{
    /**
     * @covers ResourceServiceDeskRoleService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ResourceServiceDeskRoleService::class,
            $this->client->resourceServiceDeskRoles()
        );
    }

    /**
     * @covers ResourceServiceDeskRoleService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->resourceServiceDeskRoles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ResourceServiceDeskRoleCollection::class,
            $result
        );
    }

    /**
     * @covers ResourceServiceDeskRoleCollection
     */
    public function test_collection_contains_resource_service_desk_role_entities()
    {
        $result = $this->client->resourceServiceDeskRoles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ResourceServiceDeskRoleEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ResourceServiceDeskRoleService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ResourceServiceDeskRoleQueryBuilder::class,
            $this->client->resourceServiceDeskRoles()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ResourceServiceDeskRoleEntity::class);

        $entity = new ResourceServiceDeskRoleEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
