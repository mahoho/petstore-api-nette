<?php

namespace App\UI\Tag;

use App\UI\XmlModel;

class TagModel extends XmlModel {
    protected $dataModelClass = TagDataModel::class;
    protected $xmlFileName = 'tags';
}
