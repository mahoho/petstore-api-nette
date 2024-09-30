<?php

namespace App\UI\Order;

use App\UI\CrudPresenter;
use App\UI\Pet\PetDataModel;
use App\UI\Pet\PetModel;
use App\UI\User\UserModel;
use DateTime;
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

    #[Requires(methods: 'GET')]
    public function actionDashboard() {
        $petsCount = count((new PetModel())->getAll());
        $ordersCount = count((new OrderModel())->getAll());
        $usersCount = count((new UserModel())->getAll());

        $this->sendJson([
            'pets'   => $petsCount,
            'orders' => $ordersCount,
            'users'  => $usersCount,
        ]);
    }

    protected function isValidData(array $data): array {
        $validations = parent::isValidData($data); // TODO: Change the autogenerated stub

        if ($validations['petId'] ?? "") {
            return $validations;
        }

        $pet = (new PetModel())->getById($data['petId']);

        if (!$pet) {
            $validations['petId'] = 'Wrong Pet ID';
        }

        if ($validations['shipDate'] ?? "") {
            return $validations;
        }

        $shipDate = $data['shipDate'];
        $shipDateObj = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $shipDate);

        if (!$shipDateObj) {
            $validations['shipDate'] = 'shipDate must follow ISO8601 format (Y-m-dTH:i:s.uZ)';
        }

        $complete = $data['complete'];
        $completeFormatted = filter_var($complete, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($completeFormatted === null) {
            $validations['complete'] = 'status must be a boolean value';
        }

        return $validations;
    }
}
