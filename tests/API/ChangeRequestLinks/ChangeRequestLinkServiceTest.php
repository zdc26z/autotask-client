<?php

use Anteris\Autotask\API\ChangeRequestLinks\ChangeRequestLinkCollection;
use Anteris\Autotask\API\ChangeRequestLinks\ChangeRequestLinkService;
use Anteris\Autotask\API\ChangeRequestLinks\ChangeRequestLinkEntity;

use Anteris\Autotask\API\ChangeRequestLinks\ChangeRequestLinkQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ChangeRequestLinkService.
 */
class ChangeRequestLinkServiceTest extends AbstractTest
{
    /**
     * @covers ChangeRequestLinkService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ChangeRequestLinkService::class,
            $this->client->changeRequestLinks()
        );
    }

    /**
     * @covers ChangeRequestLinkService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->changeRequestLinks()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ChangeRequestLinkCollection::class,
            $result
        );
    }

    /**
     * @covers ChangeRequestLinkCollection
     */
    public function test_collection_contains_change_request_link_entities()
    {
        $result = $this->client->changeRequestLinks()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ChangeRequestLinkEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ChangeRequestLinkService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ChangeRequestLinkQueryBuilder::class,
            $this->client->changeRequestLinks()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ChangeRequestLinkEntity::class);

        $entity = new ChangeRequestLinkEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
