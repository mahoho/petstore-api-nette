<?php

namespace App\UI\Tag;

use App\DataModels\Tag;
use App\UI\XmlModel;

class TagModel extends XmlModel {
    protected $dataModelClass = Tag::class;
    protected $xmlFileName = 'tags';
}
