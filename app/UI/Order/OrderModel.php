<?php

namespace App\UI\Order;

use App\UI\XmlModel;

class OrderModel extends XmlModel {
    protected $dataModelClass = OrderDataModel::class;
    protected $xmlFileName = 'orders';
}
