<?php

use Anteris\Autotask\API\OpportunityCategories\OpportunityCategoryCollection;
use Anteris\Autotask\API\OpportunityCategories\OpportunityCategoryService;
use Anteris\Autotask\API\OpportunityCategories\OpportunityCategoryEntity;

use Anteris\Autotask\API\OpportunityCategories\OpportunityCategoryQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for OpportunityCategoryService.
 */
class OpportunityCategoryServiceTest extends AbstractTest
{
    /**
     * @covers OpportunityCategoryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            OpportunityCategoryService::class,
            $this->client->opportunityCategories()
        );
    }

    /**
     * @covers OpportunityCategoryService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->opportunityCategories()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            OpportunityCategoryCollection::class,
            $result
        );
    }

    /**
     * @covers OpportunityCategoryCollection
     */
    public function test_collection_contains_opportunity_category_entities()
    {
        $result = $this->client->opportunityCategories()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                OpportunityCategoryEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers OpportunityCategoryService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            OpportunityCategoryQueryBuilder::class,
            $this->client->opportunityCategories()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), OpportunityCategoryEntity::class);

        $entity = new OpportunityCategoryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
