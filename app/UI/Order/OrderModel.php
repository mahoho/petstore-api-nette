<?php

namespace App\UI\Order;

use App\DataModels\Order;
use App\UI\XmlModel;

class OrderModel extends XmlModel {
    protected $dataModelClass = Order::class;
    protected $xmlFileName = 'orders';
}
