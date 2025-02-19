<?php

use Anteris\Autotask\API\CompanyWebhookFields\CompanyWebhookFieldCollection;
use Anteris\Autotask\API\CompanyWebhookFields\CompanyWebhookFieldService;
use Anteris\Autotask\API\CompanyWebhookFields\CompanyWebhookFieldEntity;

use Anteris\Autotask\API\CompanyWebhookFields\CompanyWebhookFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanyWebhookFieldService.
 */
class CompanyWebhookFieldServiceTest extends AbstractTest
{
    /**
     * @covers CompanyWebhookFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanyWebhookFieldService::class,
            $this->client->companyWebhookFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanyWebhookFieldEntity::class);

        $entity = new CompanyWebhookFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
