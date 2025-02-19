<?php

use Anteris\Autotask\API\Skills\SkillCollection;
use Anteris\Autotask\API\Skills\SkillService;
use Anteris\Autotask\API\Skills\SkillEntity;

use Anteris\Autotask\API\Skills\SkillQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for SkillService.
 */
class SkillServiceTest extends AbstractTest
{
    /**
     * @covers SkillService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            SkillService::class,
            $this->client->skills()
        );
    }

    /**
     * @covers SkillService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->skills()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            SkillCollection::class,
            $result
        );
    }

    /**
     * @covers SkillCollection
     */
    public function test_collection_contains_skill_entities()
    {
        $result = $this->client->skills()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                SkillEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers SkillService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            SkillQueryBuilder::class,
            $this->client->skills()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), SkillEntity::class);

        $entity = new SkillEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
