<?php

namespace App\UI\Order;

use App\DataModels\Support\DataModel;

/**
 * OrderDataModel Class Doc Comment
 * @property $id
 * @property $petId
 * @property $quantity
 * @property $shipDate
 * @property $status
 * @property $complete
 *
 * @link     https://openapi-generator.tech
 */
class OrderDataModel extends DataModel {
    public const STATUS_PLACED = 'placed';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_DELIVERED = 'delivered';
    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OrderDataModel';
    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'       => 'int',
        'petId'    => 'int',
        'quantity' => 'int',
        'shipDate' => '\DateTime',
        'status'   => 'string',
        'complete' => 'bool'
    ];
    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id'       => 'int64',
        'petId'    => 'int64',
        'quantity' => 'int32',
        'shipDate' => 'date-time',
        'status'   => null,
        'complete' => null
    ];
    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id'       => false,
        'petId'    => false,
        'quantity' => false,
        'shipDate' => false,
        'status'   => false,
        'complete' => false
    ];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null) {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('petId', $data ?? [], null);
        $this->setIfExists('quantity', $data ?? [], null);
        $this->setIfExists('shipDate', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('complete', $data ?? [], null);
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues() {
        return [
            self::STATUS_PLACED,
            self::STATUS_APPROVED,
            self::STATUS_DELIVERED,
        ];
    }

    public function listInvalidProperties() {
        $invalidProperties = [];

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties['status'] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }
}


