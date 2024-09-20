<?php

namespace App\DataModels;

use App\DataModels\Support\DataModel;
use App\DataModels\Support\ObjectSerializer;


/**
 * Pet Class Doc Comment
 *
 * @property int $id
 * @property string $name
 * @property ?Category $category
 * @property string[] $photoUrls
 * @property Tag[] $tags
 * @property string $status
 *
 * @link     https://openapi-generator.tech
 */
class Pet extends DataModel {
    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'Pet';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'        => 'int',
        'name'      => 'string',
        'category'  => '\App\ClientModels\Category',
        'photoUrls' => 'string[]',
        'tags'      => '\App\ClientModels\Tag[]',
        'status'    => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id'        => 'int64',
        'name'      => null,
        'category'  => null,
        'photoUrls' => null,
        'tags'      => null,
        'status'    => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id'        => false,
        'name'      => false,
        'category'  => false,
        'photoUrls' => false,
        'tags'      => false,
        'status'    => false
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id'        => 'id',
        'name'      => 'name',
        'category'  => 'category',
        'photoUrls' => 'photoUrlss',
        'tags'      => 'tags',
        'status'    => 'status'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id'        => 'setId',
        'name'      => 'setName',
        'category'  => 'setCategory',
        'photoUrls' => 'setphotoUrlss',
        'tags'      => 'setTags',
        'status'    => 'setStatus'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id'        => 'getId',
        'name'      => 'getName',
        'category'  => 'getCategory',
        'photoUrls' => 'getphotoUrlss',
        'tags'      => 'getTags',
        'status'    => 'getStatus'
    ];

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_PENDING = 'pending';
    public const STATUS_SOLD = 'sold';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues() {
        return [
            self::STATUS_AVAILABLE,
            self::STATUS_PENDING,
            self::STATUS_SOLD,
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('photoUrls', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties() {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties['name'] = "'name' can't be null";
        }
        if ($this->container['photoUrls'] === null) {
            $invalidProperties['photoUrls'] = "'photoUrls' can't be null";
        }
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

    /**
     * Gets name
     *
     * @return string
     */
    public function getName() {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return self
     */
    public function setName($name) {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets category
     *
     * @return \App\DataModels\Category|null
     */
    public function getCategory() {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param \App\DataModels\Category|null $category category
     *
     * @return self
     */
    public function setCategory($category) {
        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets photoUrls
     *
     * @return string[]
     */
    public function getPhotoUrls() {
        return $this->container['photoUrls'];
    }

    /**
     * Sets photoUrls
     *
     * @param string[] $photoUrls photoUrls
     *
     * @return self
     */
    public function setPhotoUrls($photoUrls) {
        if (is_null($photoUrls)) {
            throw new \InvalidArgumentException('non-nullable photoUrls cannot be null');
        }
        $this->container['photoUrls'] = $photoUrls;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return \App\DataModels\Tag[]|null
     */
    public function getTags() {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param \App\DataModels\Tag[]|null $tags tags
     *
     * @return self
     */
    public function setTags($tags) {
        if (is_null($tags)) {
            throw new \InvalidArgumentException('non-nullable tags cannot be null');
        }
        $this->container['tags'] = $tags;

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
     * @param string|null $status pet status in the store
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
}
