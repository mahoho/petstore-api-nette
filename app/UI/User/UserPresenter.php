<?php

namespace App\UI\User;

use App\UI\CrudPresenter;

class UserPresenter  extends CrudPresenter {
    protected string $modelClass = UserModel::class;
    protected string $dataModelClass = UserDataModel::class;
}
