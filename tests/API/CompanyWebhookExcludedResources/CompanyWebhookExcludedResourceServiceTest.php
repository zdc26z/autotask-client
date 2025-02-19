<?php

use Anteris\Autotask\API\CompanyWebhookExcludedResources\CompanyWebhookExcludedResourceCollection;
use Anteris\Autotask\API\CompanyWebhookExcludedResources\CompanyWebhookExcludedResourceService;
use Anteris\Autotask\API\CompanyWebhookExcludedResources\CompanyWebhookExcludedResourceEntity;

use Anteris\Autotask\API\CompanyWebhookExcludedResources\CompanyWebhookExcludedResourceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for CompanyWebhookExcludedResourceService.
 */
class CompanyWebhookExcludedResourceServiceTest extends AbstractTest
{
    /**
     * @covers CompanyWebhookExcludedResourceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            CompanyWebhookExcludedResourceService::class,
            $this->client->companyWebhookExcludedResources()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), CompanyWebhookExcludedResourceEntity::class);

        $entity = new CompanyWebhookExcludedResourceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
