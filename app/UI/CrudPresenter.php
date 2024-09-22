<?php

namespace App\UI;

use App\Services\ApiAuthMiddleware;
use Nette\Application\Attributes\Requires;
use Nette\Application\UI\Presenter;
use Nette\DI\InvalidConfigurationException;

abstract class CrudPresenter extends Presenter {
    protected string $modelClass;
    protected string $dataModelClass;

    protected XmlModel $model;

    private $apiAuthMiddleware;

    public function startup() {
        parent::startup();

        // Obtain current presenter and action
        $presenterName = $this->getName();
        $actionName = $this->getAction();

        // Manually handle the middleware as Nette doesn't have built-in support
        $this->apiAuthMiddleware->handle($presenterName, $actionName, function() {
            // Proceed with `startup` logic after middleware
        });
    }

    public function __construct(ApiAuthMiddleware $apiAuthMiddleware) {
        parent::__construct();

        if (!$this->modelClass) {
            $className = __CLASS__;

            throw new InvalidConfigurationException("\$modelClass property must be set for class $className");
        }

        $this->model = new $this->modelClass;
        $this->apiAuthMiddleware = $apiAuthMiddleware;
    }

    public function actionDefault() {
        $id = $this->request->getParameter('id');
        $httpMethod = $this->request->getMethod();

        if ($httpMethod === 'GET') {
            $this->actionRead($id);
        }

        if (in_array($httpMethod, ['PUT', 'POST']) && $id) {
            $this->actionUpdate($id);
        }

        if (in_array($httpMethod, ['PUT', 'POST']) && $id) {
            $this->actionUpdate($id);
        }

        if ($httpMethod === 'POST' && !$id) {
            $this->actionCreate();
        }

        if ($httpMethod === 'DELETE') {
            $this->actionDelete($id);
        }
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

    #[Requires(methods: 'POST')]
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

    #[Requires(methods: 'PUT')]
    public function actionUpdate(int|string $id): void {
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

    #[Requires(methods: 'DELETE')]
    public function actionDelete(int|string $id): void {
        $this->model->deleteItem($id);
        $this->sendJson(['message' => 'Item deleted']);
    }

    protected function isValidData(array $data): array {
        $dataModel = new $this->dataModelClass($data);
        return $dataModel->listInvalidProperties();
    }
}
