<?php

namespace App\UI\Category;

use App\UI\Category\CategoryDataModel;
use App\UI\XmlModel;

class CategoryModel extends XmlModel {
    protected $dataModelClass = CategoryDataModel::class;
    protected $xmlFileName = 'categories';
}
