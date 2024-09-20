<?php

namespace App\DataModels\Support;

use DOMDocument;
use DOMElement;
use DOMNodeList;

class XmlToArray {

	/* @var $shouldBeList array */
	private static $shouldBeList = [];

	/* @var $shouldBeArray array */
	private static $shouldBeArray = [];

	/* @var $nodeNameLocation string 	nodeName|localName */
	private static $nodeNameLocation;

	/**
	 * @param string $xmlString
	 * @param array $shouldBeList   Elements that should be in non-assoc array. Sample: ['elementName' => 'parentElement']. parentElement could be empty
	 * @param array $shouldBeArray  Elements that will be forced to be array if empty (they will be empty string otherwise). Sample: ['elementName' => 'parentElement']. parentElement could be empty
     * @param bool $stripNamespaces
	 *
	 * @return array
	 */
	public static function convert($xmlString, $shouldBeList = [], $shouldBeArray = [], $stripNamespaces = true): array{
		if (!$xmlString) {
			return [];
		}

		$xmlString = self::escapeAmpersand($xmlString);

		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($xmlString);

		self::$shouldBeList = $shouldBeList;
		self::$shouldBeArray = $shouldBeArray;
		self::$nodeNameLocation = $stripNamespaces ? 'localName' : 'nodeName';

		return self::processNode($dom->documentElement);
	}

	/**
	 * @param DOMElement $node
	 * @return array|string|null
	 */
	private static function processNode($node){
		/* @var $node DOMElement */
		switch ($node->nodeType) {
			case XML_CDATA_SECTION_NODE:
			case XML_TEXT_NODE: {
				return $node->nodeValue;
			}
			case XML_ELEMENT_NODE: {
				$resultElements = [];
				$nodeName = self::name($node);

				$repeatingChildNames = self::repeatingChildNames($node->childNodes);

				/* @var $childNode DOMElement */
				foreach ($node->childNodes as $childNode) {
					$childName = self::name($childNode);

					$childProcessResult = self::processNode($childNode);
					if ($childProcessResult === '' && self::shouldBeArrayElement($childName, $nodeName)) {
						$childProcessResult = [];
					}

					if ($childName === null) { // текстовая нода
						if (self::hasOnlyOneChild($node)) {
							return $childProcessResult;
						}

                        $resultElements['@'] = $childProcessResult;
                    } else {
						$isRepeatingElement = isset($repeatingChildNames[$childName]);
						$shouldBeListElement = $isRepeatingElement || self::shouldBeListElement($childName, $nodeName);

						if ($shouldBeListElement) {
							$resultElements[$childName][] = $childProcessResult;
						} else {
							$resultElements[$childName] = $childProcessResult;
						}
					}
				}

				$resultAttributes = [];
				foreach ($node->attributes as $attrNode) {
					$resultAttributes['@' . self::name($attrNode)] = $attrNode->nodeValue;
				}

				return ($resultAttributes + $resultElements) ?: ''; // атрибуты перед элементами
			}
			default: {
				return null;
			}
		}
	}

	/**
	 * @param DOMElement $node
	 * @return string
	 */
	private static function name($node): ?string{
		return $node->{self::$nodeNameLocation};
	}

	/**
	 * @param DOMElement $node
	 * @return bool
	 */
	private static function hasOnlyOneChild($node): bool{
		return $node->attributes->length === 0 && $node->childNodes->length === 1;
	}

	/**
	 * @param string $name
	 * @param string $parentName
	 * @return bool
	 */
	private static function shouldBeListElement($name, $parentName): bool{
		return self::shouldBeX(self::$shouldBeList, $name, $parentName);
	}

	/**
	 * @param string $name
	 * @param string $parentName
	 * @return bool
	 */
	private static function shouldBeArrayElement($name, $parentName): bool{
		return self::shouldBeX(self::$shouldBeArray, $name, $parentName);
	}

	/**
	 * @param array $shouldBeSomething
	 * @param string $name
	 * @param string $parentName
	 * @return bool
	 */
	private static function shouldBeX($shouldBeSomething, $name, $parentName): bool{
		return
			isset($shouldBeSomething[$name]) &&
			($shouldBeSomething[$name] === '' || $shouldBeSomething[$name] === $parentName);
	}

	/**
	 * @param DOMNodeList $childNodes
	 * @return array
	 */
	private static function repeatingChildNames($childNodes): array{
		$childNames = [];
		foreach ($childNodes as $childNode) {
			$name = self::name($childNode);
			$childNames[$name] = ($childNames[$name] ?? 0) + 1;
		}

		return array_filter($childNames, static function($value){
			return $value > 1;
		});
	}

	/**
	 * @link https://stackoverflow.com/a/16423126
	 * @param string $xmlString
	 * @return string
	 */
	private static function escapeAmpersand($xmlString): string{
		return preg_replace('/&(?!(?:apos|quot|[gl]t|amp);|#)/', '&amp;', $xmlString);
	}

}
