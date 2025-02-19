<?php

use Anteris\Autotask\API\ConfigurationItemSslSubjectAlternativeNames\ConfigurationItemSslSubjectAlternativeNameCollection;
use Anteris\Autotask\API\ConfigurationItemSslSubjectAlternativeNames\ConfigurationItemSslSubjectAlternativeNameService;
use Anteris\Autotask\API\ConfigurationItemSslSubjectAlternativeNames\ConfigurationItemSslSubjectAlternativeNameEntity;

use Anteris\Autotask\API\ConfigurationItemSslSubjectAlternativeNames\ConfigurationItemSslSubjectAlternativeNameQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemSslSubjectAlternativeNameService.
 */
class ConfigurationItemSslSubjectAlternativeNameServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemSslSubjectAlternativeNameService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemSslSubjectAlternativeNameService::class,
            $this->client->configurationItemSslSubjectAlternativeNames()
        );
    }

    /**
     * @covers ConfigurationItemSslSubjectAlternativeNameService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->configurationItemSslSubjectAlternativeNames()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ConfigurationItemSslSubjectAlternativeNameCollection::class,
            $result
        );
    }

    /**
     * @covers ConfigurationItemSslSubjectAlternativeNameCollection
     */
    public function test_collection_contains_configuration_item_ssl_subject_alternative_name_entities()
    {
        $result = $this->client->configurationItemSslSubjectAlternativeNames()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ConfigurationItemSslSubjectAlternativeNameEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ConfigurationItemSslSubjectAlternativeNameService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ConfigurationItemSslSubjectAlternativeNameQueryBuilder::class,
            $this->client->configurationItemSslSubjectAlternativeNames()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemSslSubjectAlternativeNameEntity::class);

        $entity = new ConfigurationItemSslSubjectAlternativeNameEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
