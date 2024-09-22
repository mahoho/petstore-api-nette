<?php

namespace App\UI;

use App\DataModels\Support\DataModel;
use App\DataModels\Support\XmlToArray;
use Doctrine\Inflector\InflectorFactory;
use Exception;
use FluidXml\FluidXml;
use Nette\DI\InvalidConfigurationException;

abstract class XmlModel {
    protected $xmlFileName;
    protected $dataModelClass;

    protected $xmlFile;

    protected string $xmlFileBasePath = __DIR__ . '/../../data/';

    protected string $idProp = 'id';

    private string $elementName;

    public function __construct() {
        if (!$this->xmlFileName) {
            $className = __CLASS__;

            throw new InvalidConfigurationException("\$xmlFileName property must be set for class $className");
        }

        if (!$this->dataModelClass) {
            $className = __CLASS__;

            throw new InvalidConfigurationException("\$dataModelClass property must be set for class $className");
        }

        $inflector = InflectorFactory::create()->build();
        $this->elementName = $inflector->singularize($this->xmlFileName);

        if(!file_exists($this->xmlFileBasePath)) {
            mkdir($this->xmlFileBasePath, 0777, true);
        }

        $this->xmlFile = $this->xmlFileBasePath . $this->xmlFileName . '.xml';
    }

    /**
     * @return array<int, DataModel>
     */
    public function getAll(): array {
        $items = $this->loadItemsFromXml();

        if (!$items) {
            return [];
        }

        return array_values($items);
    }

    /**
     * Return collection of items keyed by ID
     *
     * @return array<int, DataModel>
     */
    public function loadItemsFromXml($keyByProp = null): ?array {
        if (!file_exists($this->xmlFile)) {
            return null;
        }

        $keyByProp = $keyByProp ?? $this->idProp;

        $xmlString = file_get_contents($this->xmlFile);

        $array = XmlToArray::convert($xmlString, [
            'tags'             => '',
            'photoUrl'         => 'photoUrls',
            $this->elementName => ""
        ], [
            'tags'     => '',
            'photoUrl' => 'photoUrls'
        ]);

        $result = [];

        foreach ($array[$this->elementName] ?? [] as $item) {
            if (!is_array($item) || empty($item[$keyByProp])) {
                continue;
            }

            $result[$item[$keyByProp]] = new $this->dataModelClass($item);
        }

        return $result;
    }

    public function getById($id): ?DataModel {
        $items = $this->loadItemsFromXml();

        if (!$items) {
            return null;
        }

        return $items[$id] ?? null;
    }

    public function addItem($data): DataModel {
        $dataPrepared = $this->prepareData($data);

        unset($dataPrepared['id']);

        $items = $this->loadItemsFromXml('id') ?? [];

        $maxId = $items ? max(array_keys($items)) : 0;

        $nextId = $maxId + 1;
        $dataPrepared['id'] = $nextId;

        $model = $dataPrepared instanceof DataModel ? $dataPrepared : new $this->dataModelClass($dataPrepared);

        $items[$nextId] = $model;

        $this->saveXml($items);

        return $model;
    }

    /**
     * Hook to modify data before create/update if needed
     *
     * @param $data
     * @return mixed
     */
    public function prepareData(DataModel|array $data) {
        return $data;
    }

    /**
     * @param array<int, DataModel> $xmlData
     * @throws Exception
     */
    protected function saveXml(array $xmlData) {
        $xml = new FluidXml(null);
        $root = $xml->addChild($this->xmlFileName, true);

        $xmlItems = [];
        foreach ($xmlData as $item) {
            /** @var DataModel $item */
            $xmlItems[] = [$this->elementName => $item->toArray()];
        }

        $root->addChild($xmlItems);

        $xml->save($this->xmlFile);
    }

    public function updateItem($data): ?DataModel {
        $items = $this->loadItemsFromXml();

        if (!$items) {
            return null;
        }

        $dataPrepared = $this->prepareData($data);
        $model = $dataPrepared instanceof DataModel ? $dataPrepared : new $this->dataModelClass($dataPrepared);

        $items[$model->{$this->idProp}] = $model;

        $this->saveXml($items);

        return $model;
    }

    public function deleteItem($id): bool {
        $items = $this->loadItemsFromXml();

        if (!$items) {
            return false;
        }

        unset($items[$id]);

        $this->saveXml($items);

        return true;
    }
}
