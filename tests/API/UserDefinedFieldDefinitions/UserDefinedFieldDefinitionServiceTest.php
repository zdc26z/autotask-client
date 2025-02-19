<?php

use Anteris\Autotask\API\UserDefinedFieldDefinitions\UserDefinedFieldDefinitionCollection;
use Anteris\Autotask\API\UserDefinedFieldDefinitions\UserDefinedFieldDefinitionService;
use Anteris\Autotask\API\UserDefinedFieldDefinitions\UserDefinedFieldDefinitionEntity;

use Anteris\Autotask\API\UserDefinedFieldDefinitions\UserDefinedFieldDefinitionQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for UserDefinedFieldDefinitionService.
 */
class UserDefinedFieldDefinitionServiceTest extends AbstractTest
{
    /**
     * @covers UserDefinedFieldDefinitionService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            UserDefinedFieldDefinitionService::class,
            $this->client->userDefinedFieldDefinitions()
        );
    }

    /**
     * @covers UserDefinedFieldDefinitionService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->userDefinedFieldDefinitions()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            UserDefinedFieldDefinitionCollection::class,
            $result
        );
    }

    /**
     * @covers UserDefinedFieldDefinitionCollection
     */
    public function test_collection_contains_user_defined_field_definition_entities()
    {
        $result = $this->client->userDefinedFieldDefinitions()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                UserDefinedFieldDefinitionEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers UserDefinedFieldDefinitionService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            UserDefinedFieldDefinitionQueryBuilder::class,
            $this->client->userDefinedFieldDefinitions()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), UserDefinedFieldDefinitionEntity::class);

        $entity = new UserDefinedFieldDefinitionEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
