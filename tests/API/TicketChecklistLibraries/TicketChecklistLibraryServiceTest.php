<?php
use Anteris\Autotask\API\TicketChecklistLibraries\TicketChecklistLibraryService;
use Anteris\Autotask\API\TicketChecklistLibraries\TicketChecklistLibraryEntity;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketChecklistLibraryService.
 */
class TicketChecklistLibraryServiceTest extends AbstractTest
{
    /**
     * @covers TicketChecklistLibraryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketChecklistLibraryService::class,
            $this->client->ticketChecklistLibraries()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketChecklistLibraryEntity::class);

        $entity = new TicketChecklistLibraryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
