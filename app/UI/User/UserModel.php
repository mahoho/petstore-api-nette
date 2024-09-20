<?php

namespace App\UI\User;

use App\DataModels\User;
use App\UI\XmlModel;

class UserModel extends XmlModel {
    protected $dataModelClass = User::class;
    protected $xmlFileName = 'users';
}
