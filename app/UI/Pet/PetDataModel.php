<?php

namespace App\UI\Pet;

use App\DataModels\Support\DataModel;
use App\UI\Tag\TagDataModel;


/**
 * Pet Class Doc Comment
 *
 * @property int $id
 * @property string $name
 * @property ?CategoryDataModel $category
 * @property string[] $photoUrls
 * @property TagDataModel[] $tags
 * @property string $status
 *
 * @link     https://openapi-generator.tech
 */
class PetDataModel extends DataModel {
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_PENDING = 'pending';
    public const STATUS_SOLD = 'sold';
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
        'category'  => '\App\UI\Category\CategoryDataModel',
        'photoUrls' => 'string[]',
        'tags'      => '\App\UI\Tag\TagDataModel[]',
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
}
