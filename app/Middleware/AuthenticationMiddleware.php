<?php

declare(strict_types=1);

namespace App\Middleware;

use Nette\Application\UI\Presenter;
use Nette\Http\IResponse;

class AuthenticationMiddleware extends Presenter {

    public function __construct() {
        parent::__construct();
    }

    protected function startup(): void {
        parent::startup();

        $authHeader = $this->getHttpRequest()->getHeader('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $this->unauthorizedResponse('Missing or invalid Authorization header');
            return;
        }

        $jwt = $matches[1];

        if (!$this->isValidToken($jwt)) {
            $this->unauthorizedResponse('Invalid or expired token');
        }
    }

    private function isValidToken(string $token): bool {
        try {
            $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));
            // Optionally, you can add checks here, such as token expiration
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function unauthorizedResponse(string $message): void {
        $this->getHttpResponse()->setCode(IResponse::S401_UNAUTHORIZED);
        $this->sendJson(['error' => $message]);
    }
}
