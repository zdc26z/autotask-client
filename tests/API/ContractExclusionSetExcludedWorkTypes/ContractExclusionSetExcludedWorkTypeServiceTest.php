<?php

use Anteris\Autotask\API\ContractExclusionSetExcludedWorkTypes\ContractExclusionSetExcludedWorkTypeCollection;
use Anteris\Autotask\API\ContractExclusionSetExcludedWorkTypes\ContractExclusionSetExcludedWorkTypeService;
use Anteris\Autotask\API\ContractExclusionSetExcludedWorkTypes\ContractExclusionSetExcludedWorkTypeEntity;

use Anteris\Autotask\API\ContractExclusionSetExcludedWorkTypes\ContractExclusionSetExcludedWorkTypeQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractExclusionSetExcludedWorkTypeService.
 */
class ContractExclusionSetExcludedWorkTypeServiceTest extends AbstractTest
{
    /**
     * @covers ContractExclusionSetExcludedWorkTypeService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractExclusionSetExcludedWorkTypeService::class,
            $this->client->contractExclusionSetExcludedWorkTypes()
        );
    }

    /**
     * @covers ContractExclusionSetExcludedWorkTypeService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractExclusionSetExcludedWorkTypes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractExclusionSetExcludedWorkTypeCollection::class,
            $result
        );
    }

    /**
     * @covers ContractExclusionSetExcludedWorkTypeCollection
     */
    public function test_collection_contains_contract_exclusion_set_excluded_work_type_entities()
    {
        $result = $this->client->contractExclusionSetExcludedWorkTypes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractExclusionSetExcludedWorkTypeEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractExclusionSetExcludedWorkTypeService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractExclusionSetExcludedWorkTypeQueryBuilder::class,
            $this->client->contractExclusionSetExcludedWorkTypes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractExclusionSetExcludedWorkTypeEntity::class);

        $entity = new ContractExclusionSetExcludedWorkTypeEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
