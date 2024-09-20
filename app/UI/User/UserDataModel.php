<?php

namespace App\UI\User;

use App\DataModels\Support\DataModel;


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
 * @property int $userStatus
 *
 * @link     https://openapi-generator.tech
 */
class UserDataModel extends DataModel {
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
        'userStatus' => 'int'
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
        'userStatus' => 'int32'
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
        'userStatus' => false
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id'         => 'id',
        'username'   => 'username',
        'firstName'  => 'firstName',
        'lastName'   => 'lastName',
        'email'      => 'email',
        'password'   => 'password',
        'phone'      => 'phone',
        'userStatus' => 'userStatus'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id'         => 'setId',
        'username'   => 'setUsername',
        'firstName'  => 'setFirstName',
        'lastName'   => 'setLastName',
        'email'      => 'setEmail',
        'password'   => 'setPassword',
        'phone'      => 'setPhone',
        'userStatus' => 'setUserStatus'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id'         => 'getId',
        'username'   => 'getUsername',
        'firstName'  => 'getFirstName',
        'lastName'   => 'getLastName',
        'email'      => 'getEmail',
        'password'   => 'getPassword',
        'phone'      => 'getPhone',
        'userStatus' => 'getUserStatus'
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
    }

    /**
     * Gets username
     *
     * @return string|null
     */
    public function getUsername() {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string|null $username username
     *
     * @return self
     */
    public function setUsername($username) {
        if (is_null($username)) {
            throw new \InvalidArgumentException('non-nullable username cannot be null');
        }
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets firstName
     *
     * @return string|null
     */
    public function getFirstName() {
        return $this->container['firstName'];
    }

    /**
     * Sets firstName
     *
     * @param string|null $firstName firstName
     *
     * @return self
     */
    public function setFirstName($firstName) {
        if (is_null($firstName)) {
            throw new \InvalidArgumentException('non-nullable firstName cannot be null');
        }
        $this->container['firstName'] = $firstName;

        return $this;
    }

    /**
     * Gets lastName
     *
     * @return string|null
     */
    public function getLastName() {
        return $this->container['lastName'];
    }

    /**
     * Sets lastName
     *
     * @param string|null $lastName lastName
     *
     * @return self
     */
    public function setLastName($lastName) {
        if (is_null($lastName)) {
            throw new \InvalidArgumentException('non-nullable lastName cannot be null');
        }
        $this->container['lastName'] = $lastName;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail() {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email email
     *
     * @return self
     */
    public function setEmail($email) {
        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets password
     *
     * @return string|null
     */
    public function getPassword() {
        return $this->container['password'];
    }

    /**
     * Sets password
     *
     * @param string|null $password password
     *
     * @return self
     */
    public function setPassword($password) {
        if (is_null($password)) {
            throw new \InvalidArgumentException('non-nullable password cannot be null');
        }
        $this->container['password'] = $password;

        return $this;
    }

    /**
     * Gets phone
     *
     * @return string|null
     */
    public function getPhone() {
        return $this->container['phone'];
    }

    /**
     * Sets phone
     *
     * @param string|null $phone phone
     *
     * @return self
     */
    public function setPhone($phone) {
        if (is_null($phone)) {
            throw new \InvalidArgumentException('non-nullable phone cannot be null');
        }
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets userStatus
     *
     * @return int|null
     */
    public function getUserStatus() {
        return $this->container['userStatus'];
    }

    /**
     * Sets userStatus
     *
     * @param int|null $userStatus UserDataModel Status
     *
     * @return self
     */
    public function setUserStatus($userStatus) {
        if (is_null($userStatus)) {
            throw new \InvalidArgumentException('non-nullable userStatus cannot be null');
        }
        $this->container['userStatus'] = $userStatus;

        return $this;
    }
}


