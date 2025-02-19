<?php

use Anteris\Autotask\API\DomainRegistrars\DomainRegistrarCollection;
use Anteris\Autotask\API\DomainRegistrars\DomainRegistrarService;
use Anteris\Autotask\API\DomainRegistrars\DomainRegistrarEntity;

use Anteris\Autotask\API\DomainRegistrars\DomainRegistrarQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DomainRegistrarService.
 */
class DomainRegistrarServiceTest extends AbstractTest
{
    /**
     * @covers DomainRegistrarService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DomainRegistrarService::class,
            $this->client->domainRegistrars()
        );
    }

    /**
     * @covers DomainRegistrarService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->domainRegistrars()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DomainRegistrarCollection::class,
            $result
        );
    }

    /**
     * @covers DomainRegistrarCollection
     */
    public function test_collection_contains_domain_registrar_entities()
    {
        $result = $this->client->domainRegistrars()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DomainRegistrarEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DomainRegistrarService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DomainRegistrarQueryBuilder::class,
            $this->client->domainRegistrars()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DomainRegistrarEntity::class);

        $entity = new DomainRegistrarEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
