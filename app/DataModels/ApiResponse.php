<?php

namespace App\DataModels;

use App\DataModels\Support\DataModel;


/**
 * ApiResponse Class Doc Comment
 *
 * @property int $code
 * @property string $type
 * @property string $message
 *
 * @link     https://openapi-generator.tech
 */
class ApiResponse extends DataModel {
    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'ApiResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'code'    => 'int',
        'type'    => 'string',
        'message' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'code'    => 'int32',
        'type'    => null,
        'message' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'code'    => false,
        'type'    => false,
        'message' => false
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'code'    => 'code',
        'type'    => 'type',
        'message' => 'message'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'code'    => 'setCode',
        'type'    => 'setType',
        'message' => 'setMessage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'code'    => 'getCode',
        'type'    => 'getType',
        'message' => 'getMessage'
    ];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null) {
        $this->setIfExists('code', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('message', $data ?? [], null);
    }
}


