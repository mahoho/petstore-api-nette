<?php

namespace App\UI\Order;

use App\UI\CrudPresenter;
use App\UI\Pet\PetDataModel;
use App\UI\Pet\PetModel;
use Nette\Application\Attributes\Requires;

class OrderPresenter extends CrudPresenter {
    protected string $dataModelClass = OrderDataModel::class;
    protected string $modelClass = OrderModel::class;

    #[Requires(methods: 'GET')]
    public function actionInventory() {
        $pets = (new PetModel())->getAll();

        $inventory = [];

        foreach ($pets as $pet) {
            /** @var PetDataModel $pet */
            $inventory[$pet->status] = $inventory[$pet->status] ?? 0;
            $inventory[$pet->status]++;
        }

        $this->sendJson($inventory);
    }
}
