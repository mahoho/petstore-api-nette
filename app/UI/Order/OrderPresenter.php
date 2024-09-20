<?php

namespace App\UI\Order;

use App\UI\CrudPresenter;

class OrderPresenter extends CrudPresenter {
    protected string $dataModelClass = OrderDataModel::class;
    protected string $modelClass = OrderModel::class;
}
