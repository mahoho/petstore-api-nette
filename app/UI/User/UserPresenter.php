<?php

namespace App\UI\User;

use App\UI\CrudPresenter;
use Nette\Application\Attributes\Requires;

class UserPresenter  extends CrudPresenter {
    protected string $modelClass = UserModel::class;
    protected string $dataModelClass = UserDataModel::class;

    #[Requires(methods: 'POST')]
    public function actionCreateWithlist(){
        $data = json_decode($this->getHttpRequest()->getRawBody(), true);

        $createdUsers = [];

        foreach ($data as $userData) {
            $user = $this->model->create($userData);
            $createdUsers[] = $user;
        }

        return $createdUsers;
    }

    #[Requires(methods: 'GET')]
    public function actionLogin(){

    }

    #[Requires(methods: 'GET')]
    public function actionLogout(){

    }
}
