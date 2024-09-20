<?php

namespace App\UI\Order;

use App\DataModels\Order;
use App\UI\CrudPresenter;

class OrderPresenter extends CrudPresenter {
    protected string $dataModelClass = Order::class;
    protected string $modelClass = OrderModel::class;
}
