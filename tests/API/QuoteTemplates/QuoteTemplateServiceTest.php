<?php

use Anteris\Autotask\API\QuoteTemplates\QuoteTemplateCollection;
use Anteris\Autotask\API\QuoteTemplates\QuoteTemplateService;
use Anteris\Autotask\API\QuoteTemplates\QuoteTemplateEntity;

use Anteris\Autotask\API\QuoteTemplates\QuoteTemplateQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for QuoteTemplateService.
 */
class QuoteTemplateServiceTest extends AbstractTest
{
    /**
     * @covers QuoteTemplateService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            QuoteTemplateService::class,
            $this->client->quoteTemplates()
        );
    }

    /**
     * @covers QuoteTemplateService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->quoteTemplates()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            QuoteTemplateCollection::class,
            $result
        );
    }

    /**
     * @covers QuoteTemplateCollection
     */
    public function test_collection_contains_quote_template_entities()
    {
        $result = $this->client->quoteTemplates()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                QuoteTemplateEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers QuoteTemplateService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            QuoteTemplateQueryBuilder::class,
            $this->client->quoteTemplates()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), QuoteTemplateEntity::class);

        $entity = new QuoteTemplateEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
