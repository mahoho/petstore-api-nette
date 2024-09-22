<?php

namespace App\UI\Pet;

use App\UI\CrudPresenter;
use Nette\Application\Attributes\Requires;
use Nette\Http\FileUpload;

class PetPresenter extends CrudPresenter {
    protected string $dataModelClass = PetDataModel::class;
    protected string $modelClass = PetModel::class;

    #[Requires(methods: 'GET')]
    public function actionFindByStatus() {
        $statuses = $this->request->getParameter('status') ?? 'available';
        $statuses = explode(',', $statuses);

        $items = $this->model->findByStatus($statuses);
        $this->sendJson($items);
    }

    #[Requires(methods: 'GET')]
    public function actionFindByTags() {
        $tags = $this->request->getParameter('tags');
        $tags = explode(',', $tags);

        $items = $this->model->findByTags($tags);
        $this->sendJson($items);
    }

    #[Requires(methods: 'POST')]
    public function actionUploadImage(int|string $id) {
        /** @var FileUpload $file */
        $file = $this->request->getFile('file');

        if (!$file || !$file->isImage()) {
            $this->getHttpResponse()->setCode(422);
            $this->sendJson(['errors' => ['file' => 'File is not an image.']]);
        }

        $safeFileName = $file->getSanitizedName();

        $file->move(__DIR__ . '/../../../www/images/' . $safeFileName);

        $fileRelPath = "/images/$safeFileName";

        $pet = $this->model->getById($id);
        if (!$pet) {
            $this->getHttpResponse()->setCode(404);
            $this->sendJson(['errors' => ['id' => 'Pet not found.']]);
        }

        $photoUrls = $pet->getPhotoUrls();
        $photoUrls[] = $fileRelPath;

        $pet->setPhotoUrls($photoUrls);
        $this->model->updateItem($pet);

        $this->sendJson(['message' => 'Image uploaded successfully.']);
    }
}
