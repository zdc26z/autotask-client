<?php

namespace Anteris\Autotask\API\ConfigurationItems;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\CastCarbon;
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
                public ?int $companyID = null,
        public ?float $id = null,
        public ?bool $isActive = null,
        public ?int $productID = null,
        public ?int $apiVendorID = null,
        public ?int $companyLocationID = null,
        public ?int $configurationItemCategoryID = null,
        public ?int $configurationItemType = null,
        public ?int $contactID = null,
        public ?int $contractID = null,
        public ?int $contractServiceBundleID = null,
        public ?int $contractServiceID = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $createdByPersonID = null,
        public ?float $dailyCost = null,
        public ?float $dattoAvailableKilobytes = null,
        public ?int $dattoDeviceMemoryMegabytes = null,
        public ?bool $dattoDrivesErrors = null,
        public ?string $dattoHostname = null,
        public ?string $dattoInternalIP = null,
        public ?int $dattoKernelVersionID = null,
        #[CastCarbon]
        public ?Carbon $dattoLastCheckInDateTime = null,
        public ?int $dattoNicSpeedKilobitsPerSecond = null,
        public ?int $dattoNumberOfAgents = null,
        public ?int $dattoNumberOfDrives = null,
        public ?int $dattoNumberOfVolumes = null,
        public ?float $dattoOffsiteUsedBytes = null,
        public ?int $dattoOSVersionID = null,
        public ?float $dattoPercentageUsed = null,
        public ?float $dattoProtectedKilobytes = null,
        public ?string $dattoRemoteIP = null,
        public ?string $dattoSerialNumber = null,
        public ?int $dattoUptimeSeconds = null,
        public ?float $dattoUsedKilobytes = null,
        public ?int $dattoZfsVersionID = null,
        public ?string $deviceNetworkingID = null,
        public ?string $domain = null,
        #[CastCarbon]
        public ?Carbon $domainExpirationDateTime = null,
        #[CastCarbon]
        public ?Carbon $domainLastUpdatedDateTime = null,
        public ?int $domainRegistrarID = null,
        #[CastCarbon]
        public ?Carbon $domainRegistrationDateTime = null,
        public ?float $hourlyCost = null,
        public ?int $impersonatorCreatorResourceID = null,
        #[CastCarbon]
        public ?Carbon $installDate = null,
        public ?int $installedByContactID = null,
        public ?int $installedByID = null,
        public ?int $lastActivityPersonID = null,
        public ?int $lastActivityPersonType = null,
        #[CastCarbon]
        public ?Carbon $lastModifiedTime = null,
        public ?string $location = null,
        public ?float $monthlyCost = null,
        public ?string $notes = null,
        public ?float $numberOfUsers = null,
        public ?int $parentConfigurationItemID = null,
        public ?float $perUseCost = null,
        public ?string $referenceNumber = null,
        public ?string $referenceTitle = null,
        public ?int $rmmDeviceAuditAntivirusStatusID = null,
        public ?int $rmmDeviceAuditArchitectureID = null,
        public ?int $rmmDeviceAuditBackupStatusID = null,
        public ?string $rmmDeviceAuditDescription = null,
        public ?int $rmmDeviceAuditDeviceTypeID = null,
        public ?int $rmmDeviceAuditDisplayAdaptorID = null,
        public ?int $rmmDeviceAuditDomainID = null,
        public ?string $rmmDeviceAuditExternalIPAddress = null,
        public ?string $rmmDeviceAuditHostname = null,
        public ?string $rmmDeviceAuditIPAddress = null,
        public ?string $rmmDeviceAuditLastUser = null,
        public ?string $rmmDeviceAuditMacAddress = null,
        public ?int $rmmDeviceAuditManufacturerID = null,
        public ?float $rmmDeviceAuditMemoryBytes = null,
        public ?int $rmmDeviceAuditMissingPatchCount = null,
        public ?int $rmmDeviceAuditMobileNetworkOperatorID = null,
        public ?string $rmmDeviceAuditMobileNumber = null,
        public ?int $rmmDeviceAuditModelID = null,
        public ?int $rmmDeviceAuditMotherboardID = null,
        public ?string $rmmDeviceAuditOperatingSystem = null,
        public ?int $rmmDeviceAuditPatchStatusID = null,
        public ?int $rmmDeviceAuditProcessorID = null,
        public ?int $rmmDeviceAuditServicePackID = null,
        public ?string $rmmDeviceAuditSnmpContact = null,
        public ?string $rmmDeviceAuditSnmpLocation = null,
        public ?string $rmmDeviceAuditSnmpName = null,
        public ?int $rmmDeviceAuditSoftwareStatusID = null,
        public ?float $rmmDeviceAuditStorageBytes = null,
        public ?float $rmmDeviceID = null,
        public ?string $rmmDeviceUid = null,
        public ?int $rmmOpenAlertCount = null,
        public ?string $serialNumber = null,
        public ?int $serviceBundleID = null,
        public ?int $serviceID = null,
        public ?int $serviceLevelAgreementID = null,
        public ?float $setupFee = null,
        public ?int $sourceChargeID = null,
        public ?int $sourceChargeType = null,
        public ?string $sslCommonName = null,
        public ?string $sslIssuedBy = null,
        public ?string $sslLocation = null,
        public ?string $sslOrganization = null,
        public ?string $sslOrganizationUnit = null,
        public ?string $sslSerialNumber = null,
        public ?string $sslSignatureAlgorithm = null,
        public ?string $sslSource = null,
        #[CastCarbon]
        public ?Carbon $sslValidFromDateTime = null,
        #[CastCarbon]
        public ?Carbon $sslValidUntilDateTime = null,
        public ?int $vendorID = null,
        #[CastCarbon]
        public ?Carbon $warrantyExpirationDate = null,
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
