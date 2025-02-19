<?php

use Anteris\Autotask\API\Roles\RoleCollection;
use Anteris\Autotask\API\Roles\RoleService;
use Anteris\Autotask\API\Roles\RoleEntity;

use Anteris\Autotask\API\Roles\RoleQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for RoleService.
 */
class RoleServiceTest extends AbstractTest
{
    /**
     * @covers RoleService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            RoleService::class,
            $this->client->roles()
        );
    }

    /**
     * @covers RoleService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->roles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            RoleCollection::class,
            $result
        );
    }

    /**
     * @covers RoleCollection
     */
    public function test_collection_contains_role_entities()
    {
        $result = $this->client->roles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                RoleEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers RoleService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            RoleQueryBuilder::class,
            $this->client->roles()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), RoleEntity::class);

        $entity = new RoleEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
