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

    private string $elementName;

    public function __construct() {
        if(!$this->xmlFileName) {
            $className = __CLASS__;

            throw new InvalidConfigurationException("\$xmlFileName property must be set for class $className");
        }

        if(!$this->dataModelClass) {
            $className = __CLASS__;

            throw new InvalidConfigurationException("\$dataModelClass property must be set for class $className");
        }

        $inflector = InflectorFactory::create()->build();
        $this->elementName = $inflector->singularize($this->xmlFileName);

        $this->xmlFile = $this->xmlFileBasePath . $this->xmlFileName . '.xml';
    }

    /**
     * @return array<int, DataModel>
     */
    public function getAll() : array {
        $items = $this->loadXml();

        if (!$items) {
            return [];
        }

        return array_values($items);
    }

    public function getById($id) : ?DataModel {
        $items = $this->loadXml();

        if (!$items) {
            return null;
        }

        return $items[$id] ?? null;
    }

    public function addItem($data) {
        $model = new $this->dataModelClass($data);

        $items = $this->loadXml();
        $items[] = $model;

        $this->saveXml($items);
    }

    public function updateItem($data) {
        $items = $this->loadXml();

        if (!$items) {
            return;
        }

        $model = new $this->dataModelClass($data);

        $items[$model->getId()] = $model;

        $this->saveXml($items);
    }

    public function deleteItem($id) {
        $items = $this->loadXml();

        if (!$items) {
            return;
        }

        unset($items[$id]);

        $this->saveXml($items);
    }

    /**
     * Return collection of items keyed by ID
     *
     * @return array<int, DataModel>
     */
    protected function loadXml() : ?array {
        if(!file_exists($this->xmlFile)) {
            return null;
        }

        $xmlString = file_get_contents($this->xmlFile);

        $array = XmlToArray::convert($xmlString, ['tags' => '', 'photoUrl' => 'photoUrls', $this->elementName => ""], ['tags' => '', 'photoUrl' => 'photoUrls']);

        $result = [];

        foreach ($array[$this->elementName] ?? [] as $item) {
            $result[$item['id']] = new $this->dataModelClass($item);
        }

        return $result;
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
}
