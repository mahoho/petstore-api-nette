<?php

namespace App\UI\Tag;

use App\UI\CrudPresenter;

class TagPresenter extends CrudPresenter {
    protected string $modelClass = TagModel::class;
    protected string $dataModelClass = TagDataModel::class;
}
