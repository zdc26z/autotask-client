<?php

use Anteris\Autotask\API\Surveys\SurveyCollection;
use Anteris\Autotask\API\Surveys\SurveyService;
use Anteris\Autotask\API\Surveys\SurveyEntity;

use Anteris\Autotask\API\Surveys\SurveyQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for SurveyService.
 */
class SurveyServiceTest extends AbstractTest
{
    /**
     * @covers SurveyService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            SurveyService::class,
            $this->client->surveys()
        );
    }

    /**
     * @covers SurveyService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->surveys()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            SurveyCollection::class,
            $result
        );
    }

    /**
     * @covers SurveyCollection
     */
    public function test_collection_contains_survey_entities()
    {
        $result = $this->client->surveys()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                SurveyEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers SurveyService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            SurveyQueryBuilder::class,
            $this->client->surveys()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), SurveyEntity::class);

        $entity = new SurveyEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
