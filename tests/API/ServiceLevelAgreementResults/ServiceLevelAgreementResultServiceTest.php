<?php

use Anteris\Autotask\API\ServiceLevelAgreementResults\ServiceLevelAgreementResultCollection;
use Anteris\Autotask\API\ServiceLevelAgreementResults\ServiceLevelAgreementResultService;
use Anteris\Autotask\API\ServiceLevelAgreementResults\ServiceLevelAgreementResultEntity;

use Anteris\Autotask\API\ServiceLevelAgreementResults\ServiceLevelAgreementResultQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ServiceLevelAgreementResultService.
 */
class ServiceLevelAgreementResultServiceTest extends AbstractTest
{
    /**
     * @covers ServiceLevelAgreementResultService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ServiceLevelAgreementResultService::class,
            $this->client->serviceLevelAgreementResults()
        );
    }

    /**
     * @covers ServiceLevelAgreementResultService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->serviceLevelAgreementResults()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ServiceLevelAgreementResultCollection::class,
            $result
        );
    }

    /**
     * @covers ServiceLevelAgreementResultCollection
     */
    public function test_collection_contains_service_level_agreement_result_entities()
    {
        $result = $this->client->serviceLevelAgreementResults()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ServiceLevelAgreementResultEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ServiceLevelAgreementResultService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ServiceLevelAgreementResultQueryBuilder::class,
            $this->client->serviceLevelAgreementResults()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ServiceLevelAgreementResultEntity::class);

        $entity = new ServiceLevelAgreementResultEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
