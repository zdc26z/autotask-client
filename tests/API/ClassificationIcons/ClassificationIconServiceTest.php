<?php

use Anteris\Autotask\API\ClassificationIcons\ClassificationIconCollection;
use Anteris\Autotask\API\ClassificationIcons\ClassificationIconService;
use Anteris\Autotask\API\ClassificationIcons\ClassificationIconEntity;

use Anteris\Autotask\API\ClassificationIcons\ClassificationIconQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ClassificationIconService.
 */
class ClassificationIconServiceTest extends AbstractTest
{
    /**
     * @covers ClassificationIconService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ClassificationIconService::class,
            $this->client->classificationIcons()
        );
    }

    /**
     * @covers ClassificationIconService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->classificationIcons()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ClassificationIconCollection::class,
            $result
        );
    }

    /**
     * @covers ClassificationIconCollection
     */
    public function test_collection_contains_classification_icon_entities()
    {
        $result = $this->client->classificationIcons()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ClassificationIconEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ClassificationIconService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ClassificationIconQueryBuilder::class,
            $this->client->classificationIcons()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ClassificationIconEntity::class);

        $entity = new ClassificationIconEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
