<?php

namespace App\UI\Pet;

use App\UI\XmlModel;

class PetModel extends XmlModel {
    protected $dataModelClass = PetDataModel::class;
    protected $xmlFileName = 'pets';
}
