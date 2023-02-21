<?php

namespace Kitspring\SpacingModule;

use DOMXPath;
use Kitspring\SpacingModule\SpacingTypes\SpacingType;
use Kitspring\SpacingModule\SpacingTypes\SpacingBodyXS;
use Kitspring\SpacingModule\SpacingTypes\SpacingTypeOne;
use Kitspring\SpacingModule\SpacingTypes\SpacingTypeTwo;
use Kitspring\SpacingModule\SpacingTypes\SpacingTypeThree;

class Converter
{

	private $links = [
		'link-xs' => 'link-xs',
		'link-sm' => 'link-sm',
		'link-md' => 'link-md',
		'link-lg' => 'link-lg',
		'link-xl' => 'link-xl',

	];
	private $changeableNodes = [
		'mega' => SpacingTypeOne::class,
		'h1' => SpacingTypeOne::class,
		'h2' => SpacingTypeOne::class,
		'h3' => SpacingTypeTwo::class,
		'h4' => SpacingTypeTwo::class,
		'h5' => SpacingTypeThree::class,
		'h6' => SpacingTypeThree::class,

		'body-xl' => SpacingTypeOne::class,
		'body-lg' => SpacingTypeThree::class,
		'body-md' => SpacingTypeOne::class,
		'body-sm' => SpacingTypeOne::class,
		'body-xs' => SpacingBodyXS::class,

		'caption-xl' => SpacingTypeOne::class,
		'caption-lg' => SpacingTypeOne::class,
		'caption-md' => SpacingTypeOne::class,
		'caption-sm' => SpacingTypeOne::class,
		'caption-xs' => SpacingTypeOne::class,
		'icon' => SpacingTypeOne::class,
		// 'link-md' => SpacingTypeTwo::class,
	];

	private $cta = [
		'link-xs' => 'link-xs',
		'link-sm' => SpacingTypeOne::class,
		'link-md' => SpacingTypeOne::class,
		'link-lg' => SpacingTypeOne::class,
		'link-xl' => SpacingTypeOne::class,
		'button-lg' => 'button-lg'
	];

	private $div = [
		'is-flex-direction-row' => 'is-flex-direction-row',
		'is-flex-direction-column' => 'is-flex-direction-column',
	];

	private $autoSpace = [
		'is-justify-spacing-between' => 'is-justify-spacing-between',
	];


	protected function keys()
	{
		return array_keys($this->changeableNodes);
	}

	protected function links()
	{
		return array_keys($this->links);
	}

	protected function cta()
	{
		return array_keys($this->cta);
	}

	protected function div()
	{
		return array_keys($this->div);
	}

	protected function autoSpace()
	{
		return array_keys($this->autoSpace);
	}


	/**
	 * @param string $html
	 * @return false|string
	 */

	public function convertHtml(string $html): bool|string
	{
		$spacingType = new SpacingType();

		libxml_use_internal_errors(true);

		$dom = new \DOMDocument();
		$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

		$lastChildNode = null;
		$neighbourMargins = null;
		$lastMargin = null;
		$neighbourChildNode = null;

		$this->doStuff($dom->firstChild, $lastChildNode, $lastMargin, $neighbourMargins, $neighbourChildNode);
		return $dom->saveHTML();
	}

	public function doStuff($dom, &$lastChildNode, &$lastMargin, &$neighbourMargins, &$neighbourChildNode)
	{
		foreach ($dom->childNodes as $childNode) {

			if ($childNode->nodeType == 1) {

				$classes = explode(' ', $childNode->getAttribute('class'));

				if (count(array_intersect($classes, $this->keys())) > 0) {
					if ($lastChildNode) {
						if ($lastChildNode->tagName != 'div') {
							if (!$this->getClassFromNode($lastChildNode)) {
								continue;
							}
							$classToAdd = $this->changeableNodes[$this->getClassFromNode($lastChildNode)];
							$spacing = new $classToAdd;


							$currentClassToAdd = $this->changeableNodes[$this->getClassFromNode($childNode)];
							$currentSpacing = new $currentClassToAdd;

							$margins = [];

							if ($spacing->alwaysOverride()) {
								$neighbourMargins = $lastChildNode;
								$lastChildNode = $childNode;
								continue;
							}

							if ($currentSpacing->alwaysOverride()) {

								$spacing = $currentSpacing;
							}

							if ($spacing->mobile()) {

								$margins[] = 'mb-' . $spacing->mobile();
							}

							if ($spacing->landscape()) {

								$margins[] = 'mb-' . $spacing->landscape() . '-landscape';
							}

							if ($spacing->tablet()) {

								$margins[] = 'mb-' . $spacing->tablet() . '-tablet';
							}

							if ($spacing->desktop()) {

								$margins[] = 'mb-' . $spacing->desktop() . '-desktop';
							}

							$marginStr = implode(' ', $margins);
							$lastMargin = $marginStr;

							if ($lastChildNode->parentNode) {

								$parentClasses = explode(' ', $lastChildNode->parentNode->getAttribute('class'));

								if (count(array_intersect($parentClasses, $this->autoSpace())) == 0) {

									$lastChildNode->setAttribute('class', trim($lastChildNode->getAttribute('class') . ' ' . $marginStr));
								}
							}


							if ($lastChildNode) {
								$neighbourChildNode = $lastChildNode;
								$neighbourMargins = $marginStr;
							}
						}
					}
				}

				if ($lastChildNode) {
					if ($lastChildNode->tagName != 'div') {
						if ($lastChildNode->tagName != 'a') {
							if (count(array_intersect($classes, $this->links())) > 0) {
								if ($neighbourMargins) {
									$lastChildNode->setAttribute('class', trim($lastChildNode->getAttribute('class') . ' ' . $neighbourMargins));
								}
							}
						}
					}
				}

				if ($childNode->tagName == 'div') {

					$nextClasses = explode(' ', $childNode->firstElementChild->getAttribute('class'));
					$divClasses = explode(' ', $childNode->getAttribute('class'));

					if (count(array_intersect($nextClasses, $this->cta())) > 0 || $childNode->firstElementChild->tagName == 'div') {
						$childNode->setAttribute('class', trim($childNode->getAttribute('class') . ' ' . 'mt-32'));
					} else {
						if (count(array_intersect($divClasses, $this->div())) > 0) {
							$childNode->setAttribute('class', trim($childNode->getAttribute('class') . ' ' . 'mb-32'));
						} else {
							$childNode->setAttribute('class', trim($childNode->getAttribute('class') . ' ' . 'mt-64'));
						}
					}
				}


				$lastChildNode = $childNode;
			}
			$this->doStuff($childNode, $lastChildNode, $lastMargin, $neighbourMargins, $neighbourChildNode);
		}
	}


	public function getClassFromNode($node): ?string
	{
		if ($node->getAttribute('class') == '') {
			return null;
		}
		$result = array_values(array_intersect(explode(' ', $node->getAttribute('class')), $this->keys()));

		if (count($result) == 0) {
			return null;
		}
		return $result[0];
	}

	/**
	 * @param $childNode
	 * @param $lastChildNode
	 * @param $neighbourMargins
	 * @param $neighbourChildNode
	 * @param array $changeableNodes
	 * @return mixed
	 */
	protected function getMarginToAdd($childNode, $lastChildNode, $neighbourMargins, $neighbourChildNode)
	{
		$lastChildClass = $this->getClassFromNode($lastChildNode);
		return $this->changeableNodes[$lastChildClass][$this->getClassFromNode($childNode)] ?? '';
	}
}
