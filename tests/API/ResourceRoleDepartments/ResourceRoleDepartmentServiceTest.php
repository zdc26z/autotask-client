<?php

use Anteris\Autotask\API\ResourceRoleDepartments\ResourceRoleDepartmentCollection;
use Anteris\Autotask\API\ResourceRoleDepartments\ResourceRoleDepartmentService;
use Anteris\Autotask\API\ResourceRoleDepartments\ResourceRoleDepartmentEntity;

use Anteris\Autotask\API\ResourceRoleDepartments\ResourceRoleDepartmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ResourceRoleDepartmentService.
 */
class ResourceRoleDepartmentServiceTest extends AbstractTest
{
    /**
     * @covers ResourceRoleDepartmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ResourceRoleDepartmentService::class,
            $this->client->resourceRoleDepartments()
        );
    }

    /**
     * @covers ResourceRoleDepartmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->resourceRoleDepartments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ResourceRoleDepartmentCollection::class,
            $result
        );
    }

    /**
     * @covers ResourceRoleDepartmentCollection
     */
    public function test_collection_contains_resource_role_department_entities()
    {
        $result = $this->client->resourceRoleDepartments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ResourceRoleDepartmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ResourceRoleDepartmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ResourceRoleDepartmentQueryBuilder::class,
            $this->client->resourceRoleDepartments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ResourceRoleDepartmentEntity::class);

        $entity = new ResourceRoleDepartmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
