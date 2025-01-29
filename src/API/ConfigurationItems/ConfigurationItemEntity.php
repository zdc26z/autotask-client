<?php

namespace Anteris\Autotask\API\ConfigurationItems;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Generator\Helpers\CastCarbon;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use Carbon\Carbon;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents ConfigurationItem entities.
 */
class ConfigurationItemEntity extends Entity
{

    /**
     * Creates a new ConfigurationItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $companyID, 
public ?float $id, 
public ?bool $isActive, 
public ?int $productID, 
public ?int $apiVendorID, 
public ?int $companyLocationID, 
public ?int $configurationItemCategoryID, 
public ?int $configurationItemType, 
public ?int $contactID, 
public ?int $contractID, 
public ?int $contractServiceBundleID, 
public ?int $contractServiceID, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?int $createdByPersonID, 
public ?float $dailyCost, 
public ?float $dattoAvailableKilobytes, 
public ?int $dattoDeviceMemoryMegabytes, 
public ?bool $dattoDrivesErrors, 
public ?string $dattoHostname, 
public ?string $dattoInternalIP, 
public ?int $dattoKernelVersionID, 
#[CastCarbon]
        public ?Carbon $dattoLastCheckInDateTime, 
public ?int $dattoNicSpeedKilobitsPerSecond, 
public ?int $dattoNumberOfAgents, 
public ?int $dattoNumberOfDrives, 
public ?int $dattoNumberOfVolumes, 
public ?float $dattoOffsiteUsedBytes, 
public ?int $dattoOSVersionID, 
public ?float $dattoPercentageUsed, 
public ?float $dattoProtectedKilobytes, 
public ?string $dattoRemoteIP, 
public ?string $dattoSerialNumber, 
public ?int $dattoUptimeSeconds, 
public ?float $dattoUsedKilobytes, 
public ?int $dattoZfsVersionID, 
public ?string $deviceNetworkingID, 
public ?string $domain, 
#[CastCarbon]
        public ?Carbon $domainExpirationDateTime, 
#[CastCarbon]
        public ?Carbon $domainLastUpdatedDateTime, 
public ?int $domainRegistrarID, 
#[CastCarbon]
        public ?Carbon $domainRegistrationDateTime, 
public ?float $hourlyCost, 
public ?int $impersonatorCreatorResourceID, 
#[CastCarbon]
        public ?Carbon $installDate, 
public ?int $installedByContactID, 
public ?int $installedByID, 
public ?int $lastActivityPersonID, 
public ?int $lastActivityPersonType, 
#[CastCarbon]
        public ?Carbon $lastModifiedTime, 
public ?string $location, 
public ?float $monthlyCost, 
public ?string $notes, 
public ?float $numberOfUsers, 
public ?int $parentConfigurationItemID, 
public ?float $perUseCost, 
public ?string $referenceNumber, 
public ?string $referenceTitle, 
public ?int $rmmDeviceAuditAntivirusStatusID, 
public ?int $rmmDeviceAuditArchitectureID, 
public ?int $rmmDeviceAuditBackupStatusID, 
public ?string $rmmDeviceAuditDescription, 
public ?int $rmmDeviceAuditDeviceTypeID, 
public ?int $rmmDeviceAuditDisplayAdaptorID, 
public ?int $rmmDeviceAuditDomainID, 
public ?string $rmmDeviceAuditExternalIPAddress, 
public ?string $rmmDeviceAuditHostname, 
public ?string $rmmDeviceAuditIPAddress, 
public ?string $rmmDeviceAuditLastUser, 
public ?string $rmmDeviceAuditMacAddress, 
public ?int $rmmDeviceAuditManufacturerID, 
public ?float $rmmDeviceAuditMemoryBytes, 
public ?int $rmmDeviceAuditMissingPatchCount, 
public ?int $rmmDeviceAuditMobileNetworkOperatorID, 
public ?string $rmmDeviceAuditMobileNumber, 
public ?int $rmmDeviceAuditModelID, 
public ?int $rmmDeviceAuditMotherboardID, 
public ?string $rmmDeviceAuditOperatingSystem, 
public ?int $rmmDeviceAuditPatchStatusID, 
public ?int $rmmDeviceAuditProcessorID, 
public ?int $rmmDeviceAuditServicePackID, 
public ?string $rmmDeviceAuditSnmpContact, 
public ?string $rmmDeviceAuditSnmpLocation, 
public ?string $rmmDeviceAuditSnmpName, 
public ?int $rmmDeviceAuditSoftwareStatusID, 
public ?float $rmmDeviceAuditStorageBytes, 
public ?float $rmmDeviceID, 
public ?string $rmmDeviceUid, 
public ?int $rmmOpenAlertCount, 
public ?string $serialNumber, 
public ?int $serviceBundleID, 
public ?int $serviceID, 
public ?int $serviceLevelAgreementID, 
public ?float $setupFee, 
public ?int $sourceChargeID, 
public ?int $sourceChargeType, 
public ?string $sslCommonName, 
public ?string $sslIssuedBy, 
public ?string $sslLocation, 
public ?string $sslOrganization, 
public ?string $sslOrganizationUnit, 
public ?string $sslSerialNumber, 
public ?string $sslSignatureAlgorithm, 
public ?string $sslSource, 
#[CastCarbon]
        public ?Carbon $sslValidFromDateTime, 
#[CastCarbon]
        public ?Carbon $sslValidUntilDateTime, 
public ?int $vendorID, 
#[CastCarbon]
        public ?Carbon $warrantyExpirationDate, 
        #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
    }

    /**
     * Creates an instance of this class from an Http response.
     *
     * @param  Response  $response  Http response.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public static function fromResponse(Response $response)
    {
        $responseArray = json_decode($response->getBody(), true);

        if (isset($responseArray['item']) === false) {
            throw new \Exception('Missing item key in response.');
        }

        $mapper = new ObjectMapperUsingReflection(
            new DefinitionProvider(
                keyFormatter: new KeyFormatterWithoutConversion(),
            ),
        );
        return $mapper->hydrateObject(self::class, $responseArray['item']);
    }
}
