<?php
namespace App\DataModels;

use App\DataModels\Support\DataModel;

/**
 * Order Class Doc Comment
 * @property $id
 * @property $petId
 * @property $quantity
 * @property $shipDate
 * @property $status
 * @property $complete
 *
 * @link     https://openapi-generator.tech
 */
class Order extends DataModel {
    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'Order';

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
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id'       => 'id',
        'petId'    => 'petId',
        'quantity' => 'quantity',
        'shipDate' => 'shipDate',
        'status'   => 'status',
        'complete' => 'complete'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id'       => 'setId',
        'petId'    => 'setPetId',
        'quantity' => 'setQuantity',
        'shipDate' => 'setShipDate',
        'status'   => 'setStatus',
        'complete' => 'setComplete'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id'       => 'getId',
        'petId'    => 'getPetId',
        'quantity' => 'getQuantity',
        'shipDate' => 'getShipDate',
        'status'   => 'getStatus',
        'complete' => 'getComplete'
    ];


    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName() {
        return self::$openAPIModelName;
    }

    public const STATUS_PLACED = 'placed';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_DELIVERED = 'delivered';

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
     * Gets petId
     *
     * @return int|null
     */
    public function getPetId() {
        return $this->container['petId'];
    }

    /**
     * Sets petId
     *
     * @param int|null $petId petId
     *
     * @return self
     */
    public function setPetId($petId) {
        if (is_null($petId)) {
            throw new \InvalidArgumentException('non-nullable petId cannot be null');
        }
        $this->container['petId'] = $petId;

        return $this;
    }

    /**
     * Gets quantity
     *
     * @return int|null
     */
    public function getQuantity() {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param int|null $quantity quantity
     *
     * @return self
     */
    public function setQuantity($quantity) {
        if (is_null($quantity)) {
            throw new \InvalidArgumentException('non-nullable quantity cannot be null');
        }
        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets shipDate
     *
     * @return \DateTime|null
     */
    public function getShipDate() {
        return $this->container['shipDate'];
    }

    /**
     * Sets shipDate
     *
     * @param \DateTime|null $shipDate shipDate
     *
     * @return self
     */
    public function setShipDate($shipDate) {
        if (is_null($shipDate)) {
            throw new \InvalidArgumentException('non-nullable shipDate cannot be null');
        }
        $this->container['shipDate'] = $shipDate;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus() {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status Order Status
     *
     * @return self
     */
    public function setStatus($status) {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets complete
     *
     * @return bool|null
     */
    public function getComplete() {
        return $this->container['complete'];
    }

    /**
     * Sets complete
     *
     * @param bool|null $complete complete
     *
     * @return self
     */
    public function setComplete($complete) {
        if (is_null($complete)) {
            throw new \InvalidArgumentException('non-nullable complete cannot be null');
        }
        $this->container['complete'] = $complete;

        return $this;
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


