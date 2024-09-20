<?php

namespace App\UI;

use Nette\Application\UI\Presenter;
use Nette\DI\InvalidConfigurationException;

abstract class CrudPresenter extends Presenter {
    protected string $modelClass;
    protected string $dataModelClass;

    protected XmlModel $model;

    public function __construct() {
        parent::__construct();

        if(!$this->modelClass) {
            $className = __CLASS__;

            throw new InvalidConfigurationException("\$modelClass property must be set for class $className");
        }

        $this->model = new $this->modelClass;
    }

    public function actionRead(int $id = null): void {
        $request = $this->getHttpRequest();

        if ($request->isMethod('POST')) {
            $this->actionCreate();
            return;
        }

        if ($id !== null) {
            $item = $this->model->getById($id);
            if ($item) {
                $this->sendJson($item);
            } else {
                $this->getHttpResponse()->setCode(404);
                $this->sendJson(['error' => 'Item not found']);
            }
        } else {
            $items = $this->model->getAll();
            $this->sendJson($items);
        }
    }

    public function actionCreate(): void {
        $data = json_decode($this->getHttpRequest()->getRawBody(), true);
        $invalidProperties = $this->isValidData($data);

        if (!empty($invalidProperties)) {
            $this->getHttpResponse()->setCode(422);
            $this->sendJson(['errors' => $invalidProperties]);
            return;
        }

        $this->model->addItem($data);
        $this->getHttpResponse()->setCode(201);
        $this->sendJson(['message' => 'Item created']);
    }

    public function actionUpdate(int $id): void {
        $data = json_decode($this->getHttpRequest()->getRawBody(), true);
        $invalidProperties = $this->isValidData($data);

        if (!empty($invalidProperties)) {
            $this->getHttpResponse()->setCode(422);
            $this->sendJson(['errors' => $invalidProperties]);
            return;
        }

        $this->model->updateItem($data);
        $this->sendJson(['message' => 'Item updated']);
    }

    public function actionDelete(int $id): void {
        $this->model->deleteItem($id);
        $this->sendJson(['message' => 'Item deleted']);
    }

    protected function isValidData(array $data): array {
        $dataModel = new $this->dataModelClass($data);
        return $dataModel->listInvalidProperties();
    }
}
