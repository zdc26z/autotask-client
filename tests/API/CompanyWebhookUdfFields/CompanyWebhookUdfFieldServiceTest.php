<?php

use Anteris\Autotask\API\CompanyWebhookUdfFields\CompanyWebhookUdfFieldCollection;
use Anteris\Autotask\API\CompanyWebhookUdfFields\CompanyWebhookUdfFieldService;
use Anteris\Autotask\API\CompanyWebhookUdfFields\CompanyWebhookUdfFieldEntity;

use Anteris\Autotask\API\CompanyWebhookUdfFields\CompanyWebhookUdfFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanyWebhookUdfFieldService.
 */
class CompanyWebhookUdfFieldServiceTest extends AbstractTest
{
    /**
     * @covers CompanyWebhookUdfFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanyWebhookUdfFieldService::class,
            $this->client->companyWebhookUdfFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanyWebhookUdfFieldEntity::class);

        $entity = new CompanyWebhookUdfFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
