<?php
use Anteris\Autotask\API\ContractServiceBundleAdjustments\ContractServiceBundleAdjustmentService;
use Anteris\Autotask\API\ContractServiceBundleAdjustments\ContractServiceBundleAdjustmentEntity;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractServiceBundleAdjustmentService.
 */
class ContractServiceBundleAdjustmentServiceTest extends AbstractTest
{
    /**
     * @covers ContractServiceBundleAdjustmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractServiceBundleAdjustmentService::class,
            $this->client->contractServiceBundleAdjustments()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractServiceBundleAdjustmentEntity::class);

        $entity = new ContractServiceBundleAdjustmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
