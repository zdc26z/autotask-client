<?php

use Anteris\Autotask\API\CompanySiteConfigurations\CompanySiteConfigurationCollection;
use Anteris\Autotask\API\CompanySiteConfigurations\CompanySiteConfigurationService;
use Anteris\Autotask\API\CompanySiteConfigurations\CompanySiteConfigurationEntity;

use Anteris\Autotask\API\CompanySiteConfigurations\CompanySiteConfigurationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanySiteConfigurationService.
 */
class CompanySiteConfigurationServiceTest extends AbstractTest
{
    /**
     * @covers CompanySiteConfigurationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanySiteConfigurationService::class,
            $this->client->companySiteConfigurations()
        );
    }

    /**
     * @covers CompanySiteConfigurationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->companySiteConfigurations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            CompanySiteConfigurationCollection::class,
            $result
        );
    }

    /**
     * @covers CompanySiteConfigurationCollection
     */
    public function test_collection_contains_company_site_configuration_entities()
    {
        $result = $this->client->companySiteConfigurations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                CompanySiteConfigurationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers CompanySiteConfigurationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            CompanySiteConfigurationQueryBuilder::class,
            $this->client->companySiteConfigurations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanySiteConfigurationEntity::class);

        $entity = new CompanySiteConfigurationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
