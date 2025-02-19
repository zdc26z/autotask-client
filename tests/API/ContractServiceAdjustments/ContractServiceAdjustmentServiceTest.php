<?php
use Anteris\Autotask\API\ContractServiceAdjustments\ContractServiceAdjustmentService;
use Anteris\Autotask\API\ContractServiceAdjustments\ContractServiceAdjustmentEntity;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractServiceAdjustmentService.
 */
class ContractServiceAdjustmentServiceTest extends AbstractTest
{
    /**
     * @covers ContractServiceAdjustmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractServiceAdjustmentService::class,
            $this->client->contractServiceAdjustments()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractServiceAdjustmentEntity::class);

        $entity = new ContractServiceAdjustmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
