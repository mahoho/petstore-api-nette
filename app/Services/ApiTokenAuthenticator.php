<?php

namespace App\Services;

use App\UI\User\UserDataModel;
use App\UI\User\UserModel;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Ramsey\Uuid\Uuid;

class ApiTokenAuthenticator implements Authenticator {
    private UserModel $userRepository;

    public function __construct(UserModel $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function authenticate(string $userName, string $password): IIdentity {
        /** @var UserDataModel $user */
        $user = $this->userRepository->getById($userName);

        if (!$user) {
            throw new AuthenticationException('Invalid username/password supplied.');
        }

        if (!password_verify($password, $user->password)) {
            throw new AuthenticationException('Invalid username/password supplied.');
        }

        $user->apiToken = hash_hmac('sha256', Uuid::uuid4(), 'login_key');
        $this->userRepository->updateItem($user);

        return $user;
    }
}
