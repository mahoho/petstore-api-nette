<?php

namespace App\UI\User;

use App\UI\XmlModel;

class UserModel extends XmlModel {
    protected $dataModelClass = UserDataModel::class;
    protected $xmlFileName = 'users';

    protected string $idProp = 'username';
}
