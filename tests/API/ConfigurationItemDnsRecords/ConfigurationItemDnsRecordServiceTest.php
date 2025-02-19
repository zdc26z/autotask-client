<?php

use Anteris\Autotask\API\ConfigurationItemDnsRecords\ConfigurationItemDnsRecordCollection;
use Anteris\Autotask\API\ConfigurationItemDnsRecords\ConfigurationItemDnsRecordService;
use Anteris\Autotask\API\ConfigurationItemDnsRecords\ConfigurationItemDnsRecordEntity;

use Anteris\Autotask\API\ConfigurationItemDnsRecords\ConfigurationItemDnsRecordQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemDnsRecordService.
 */
class ConfigurationItemDnsRecordServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemDnsRecordService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemDnsRecordService::class,
            $this->client->configurationItemDnsRecords()
        );
    }

    /**
     * @covers ConfigurationItemDnsRecordService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->configurationItemDnsRecords()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ConfigurationItemDnsRecordCollection::class,
            $result
        );
    }

    /**
     * @covers ConfigurationItemDnsRecordCollection
     */
    public function test_collection_contains_configuration_item_dns_record_entities()
    {
        $result = $this->client->configurationItemDnsRecords()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ConfigurationItemDnsRecordEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ConfigurationItemDnsRecordService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ConfigurationItemDnsRecordQueryBuilder::class,
            $this->client->configurationItemDnsRecords()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemDnsRecordEntity::class);

        $entity = new ConfigurationItemDnsRecordEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
