<?php

namespace App\UI\User;

use App\DataModels\Support\DataModel;
use Nette\Security\IIdentity;


/**
 * UserDataModel Class Doc Comment
 *
 * @property int $id
 * @property string $username
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $apiToken
 * @property int $userStatus
 *
 * @link     https://openapi-generator.tech
 * @method array getData()
 */
class UserDataModel extends DataModel implements IIdentity {
    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'UserDataModel';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'         => 'int',
        'username'   => 'string',
        'firstName'  => 'string',
        'lastName'   => 'string',
        'email'      => 'string',
        'password'   => 'string',
        'phone'      => 'string',
        'userStatus' => 'int',
        'apiToken'   => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id'         => 'int64',
        'username'   => null,
        'firstName'  => null,
        'lastName'   => null,
        'email'      => null,
        'password'   => null,
        'phone'      => null,
        'userStatus' => 'int32',
        'apiToken'   => null,

    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id'         => false,
        'username'   => false,
        'firstName'  => false,
        'lastName'   => false,
        'email'      => false,
        'password'   => false,
        'phone'      => false,
        'userStatus' => false,
        'apiToken'   => false,
    ];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null) {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('username', $data ?? [], null);
        $this->setIfExists('firstName', $data ?? [], null);
        $this->setIfExists('lastName', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('password', $data ?? [], null);
        $this->setIfExists('phone', $data ?? [], null);
        $this->setIfExists('userStatus', $data ?? [], null);
        $this->setIfExists('apiToken', $data ?? [], null);
    }

    function getRoles(): array {
        return [];
    }

    function getId() {
       return $this->id;
    }
}


