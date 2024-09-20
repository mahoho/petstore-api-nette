<?php

namespace App\UI\Pet;

use App\DataModels\Pet;
use App\UI\XmlModel;

class PetModel extends XmlModel {
    protected $dataModelClass = Pet::class;
    protected $xmlFileName = 'pets';
}
