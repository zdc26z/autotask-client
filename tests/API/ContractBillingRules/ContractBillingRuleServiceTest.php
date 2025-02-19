<?php

use Anteris\Autotask\API\ContractBillingRules\ContractBillingRuleCollection;
use Anteris\Autotask\API\ContractBillingRules\ContractBillingRuleService;
use Anteris\Autotask\API\ContractBillingRules\ContractBillingRuleEntity;

use Anteris\Autotask\API\ContractBillingRules\ContractBillingRuleQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractBillingRuleService.
 */
class ContractBillingRuleServiceTest extends AbstractTest
{
    /**
     * @covers ContractBillingRuleService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractBillingRuleService::class,
            $this->client->contractBillingRules()
        );
    }

    /**
     * @covers ContractBillingRuleService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractBillingRules()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractBillingRuleCollection::class,
            $result
        );
    }

    /**
     * @covers ContractBillingRuleCollection
     */
    public function test_collection_contains_contract_billing_rule_entities()
    {
        $result = $this->client->contractBillingRules()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractBillingRuleEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractBillingRuleService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractBillingRuleQueryBuilder::class,
            $this->client->contractBillingRules()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractBillingRuleEntity::class);

        $entity = new ContractBillingRuleEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
