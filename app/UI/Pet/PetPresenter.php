<?php

namespace App\UI\Pet;

use App\DataModels\Pet;
use App\UI\CrudPresenter;

class PetPresenter extends CrudPresenter {
    protected string $dataModelClass = Pet::class;
    protected string $modelClass = PetModel::class;
}
