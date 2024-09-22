<?php

namespace App\UI\User;

use App\UI\CrudPresenter;
use Nette\Application\Attributes\Requires;
use Nette\Security\AuthenticationException;

class UserPresenter extends CrudPresenter {
    protected string $modelClass = UserModel::class;
    protected string $dataModelClass = UserDataModel::class;

    #[Requires(methods: 'POST')]
    public function actionCreateWithList() {
        $data = json_decode($this->getHttpRequest()->getRawBody(), true);

        $createdUsers = [];

        foreach ($data as $userData) {
            unset($userData['id']);

            if($invalidProperties = $this->isValidData($userData)) {
                $this->getHttpResponse()->setCode(422);
                $this->sendJson(['errors' => $invalidProperties]);
            }

            $user = $this->model->addItem($userData);
            $createdUsers[] = $user;
        }

        $this->sendJson($createdUsers);
    }

    #[Requires(methods: ['GET', 'POST'])]
    public function actionLogin() {
        $userName = $this->request->getParameter('username');
        $password = $this->request->getParameter('password');

        try {
            $user = $this->user->getAuthenticator()->authenticate($userName, $password);
            $this->user->login($user);

            $this->sendJson(['api_token' => $user->apiToken]);
        } catch (AuthenticationException $e) {
            $this->getHttpResponse()->setCode(400);
            $this->sendJson(['error' => 'Invalid username/password supplied']);
        }
    }

    #[Requires(methods: 'GET')]
    public function actionLogout() {
        $user = $this->user->getIdentity();
        $user->apiToken = null;

        $this->model->updateItem($user);

        $this->sendJson(['message' => 'Logged out']);
    }

    protected function isValidData(array $data): array {
        $result = parent::isValidData($data);
        $userName = $data['username'] ?? "";

        // username is required will be a part validation messages
        if(!$userName){
            return $result;
        }

        $id = $data['id'] ?? '';

        $userNameExists = false;
        // username should be unique
        $allItems = $this->model->loadItemsFromXml('id');
        foreach ($allItems as $item) {
            if($item['username'] === $userName && (!$id || $id !== $item['id'])){
                $userNameExists = true;
                break;
            }
        }

        if($userNameExists){
            $result['username'] = "username '$userName' already exists";
        }

        return $result;
    }
}
