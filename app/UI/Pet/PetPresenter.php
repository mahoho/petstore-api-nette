<?php

namespace App\UI\Pet;

use App\UI\CrudPresenter;

class PetPresenter extends CrudPresenter {
    protected string $dataModelClass = PetDataModel::class;
    protected string $modelClass = PetModel::class;
}
