<?php

namespace App\UI\Tag;

use App\DataModels\Tag;
use App\UI\CrudPresenter;

class TagPresenter  extends CrudPresenter {
    protected string $modelClass = TagModel::class;
    protected string $dataModelClass = Tag::class;
}
