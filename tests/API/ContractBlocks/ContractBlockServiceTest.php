<?php

use Anteris\Autotask\API\ContractBlocks\ContractBlockCollection;
use Anteris\Autotask\API\ContractBlocks\ContractBlockService;
use Anteris\Autotask\API\ContractBlocks\ContractBlockEntity;

use Anteris\Autotask\API\ContractBlocks\ContractBlockQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractBlockService.
 */
class ContractBlockServiceTest extends AbstractTest
{
    /**
     * @covers ContractBlockService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractBlockService::class,
            $this->client->contractBlocks()
        );
    }

    /**
     * @covers ContractBlockService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractBlocks()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractBlockCollection::class,
            $result
        );
    }

    /**
     * @covers ContractBlockCollection
     */
    public function test_collection_contains_contract_block_entities()
    {
        $result = $this->client->contractBlocks()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractBlockEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractBlockService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractBlockQueryBuilder::class,
            $this->client->contractBlocks()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractBlockEntity::class);

        $entity = new ContractBlockEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
