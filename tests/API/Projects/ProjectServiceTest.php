<?php

use Anteris\Autotask\API\Projects\ProjectCollection;
use Anteris\Autotask\API\Projects\ProjectService;
use Anteris\Autotask\API\Projects\ProjectEntity;

use Anteris\Autotask\API\Projects\ProjectQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ProjectService.
 */
class ProjectServiceTest extends AbstractTest
{
    /**
     * @covers ProjectService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ProjectService::class,
            $this->client->projects()
        );
    }

    /**
     * @covers ProjectService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->projects()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ProjectCollection::class,
            $result
        );
    }

    /**
     * @covers ProjectCollection
     */
    public function test_collection_contains_project_entities()
    {
        $result = $this->client->projects()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ProjectEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ProjectService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ProjectQueryBuilder::class,
            $this->client->projects()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ProjectEntity::class);

        $entity = new ProjectEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
