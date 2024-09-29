<?php

namespace App\Services;

use App\UI\User\UserModel;
use Nette\Http\Request;
use Nette\Http\Response;
use Nette\Security\AuthenticationException;
use Nette\Security\User;

class ApiAuthMiddleware {
    private $user;
    private $httpRequest;
    private $httpResponse;

    public function __construct(User $user, Request $httpRequest, Response $httpResponse) {
        $this->user = $user;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
    }

    public function handle(string $presenterName, string $actionName, callable $next) {
        $route = $presenterName . ':' . $actionName;
        $excludedRoutes = $this->getExcludedRoutes();

//        return $next();

        if (in_array($route, $excludedRoutes, true)) {
            return $next();
        }
        // Determine if the current action should be excluded from authentication


        if (in_array($route, $excludedRoutes, true)) {
            return $next();
        }

        $authHeader = $this->httpRequest->getHeader('Authorization');

        if ($authHeader && strpos($authHeader, 'Bearer ') === 0) {
            $apiToken = substr($authHeader, 7);

            $user = (new UserModel())->getByApiToken($apiToken);

            if (!$user) {
                $this->httpResponse->setCode(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Invalid API token']);
                exit;
            }

            try {
                $this->user->login($user);
                return $next();
            } catch (AuthenticationException $e) {
                $this->httpResponse->setCode(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }
        } else {
            $this->httpResponse->setCode(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Missing or malformed Authorization header']);
            exit;
        }
    }

    // Define which routes should be excluded from authentication.
    private function getExcludedRoutes(): array {
        return [
            'User:login',
            'User:createWithList',
        ];
    }
}
