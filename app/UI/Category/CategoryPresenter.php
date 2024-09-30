<?php

namespace App\UI\Category;

use App\UI\CrudPresenter;

class CategoryPresenter extends CrudPresenter {
    protected string $modelClass = CategoryModel::class;
    protected string $dataModelClass = CategoryDataModel::class;
}
