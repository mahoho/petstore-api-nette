<?php

namespace App\UI\Pet;

use App\UI\XmlModel;

class PetModel extends XmlModel {
    protected $dataModelClass = PetDataModel::class;
    protected $xmlFileName = 'pets';

    public function findByStatus(array $statuses = []) {
        $items = $this->getAll();

        return array_filter($items, function (PetDataModel $item) use ($statuses) {
            return in_array($item->getStatus(), $statuses);
        });
    }

    public function findByTags(array $tags = []) {
        $items = $this->getAll();

        return array_filter($items, function (PetDataModel $item) use ($tags) {
            $petTags = array_column($item->getTags(), 'name');

            return array_intersect($tags, $petTags);
        });
    }
}
