<?php

use Anteris\Autotask\API\CompanyWebhooks\CompanyWebhookCollection;
use Anteris\Autotask\API\CompanyWebhooks\CompanyWebhookService;
use Anteris\Autotask\API\CompanyWebhooks\CompanyWebhookEntity;

use Anteris\Autotask\API\CompanyWebhooks\CompanyWebhookQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanyWebhookService.
 */
class CompanyWebhookServiceTest extends AbstractTest
{
    /**
     * @covers CompanyWebhookService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanyWebhookService::class,
            $this->client->companyWebhooks()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanyWebhookEntity::class);

        $entity = new CompanyWebhookEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
