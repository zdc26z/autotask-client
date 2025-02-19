<?php
use Anteris\Autotask\API\DocumentChecklistLibraries\DocumentChecklistLibraryService;
use Anteris\Autotask\API\DocumentChecklistLibraries\DocumentChecklistLibraryEntity;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentChecklistLibraryService.
 */
class DocumentChecklistLibraryServiceTest extends AbstractTest
{
    /**
     * @covers DocumentChecklistLibraryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentChecklistLibraryService::class,
            $this->client->documentChecklistLibraries()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentChecklistLibraryEntity::class);

        $entity = new DocumentChecklistLibraryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
