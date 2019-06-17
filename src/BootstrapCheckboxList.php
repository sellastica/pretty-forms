<?php
namespace Sellastica\PrettyForms;

use Nette\Utils\Html;

class BootstrapCheckboxList extends \Nette\Forms\Controls\CheckboxList
{
	/**
	 * @param string|object
	 * @param array|null $items
	 */
	public function __construct($label = null, array $items = null)
	{
		parent::__construct($label, $items);
		$this->separator = '';
	}

	/**
	 * Generates control's HTML element.
	 * @return Html
	 */
	public function getControl()
	{
		$items = $this->getItems();
		reset($items);

		$html = Html::el();
		$htmlItems = [];
		foreach ($this->translate($items) as $key => $item) {
			$el = Html::el('div')->setAttribute('class', 'checkbox ' . ($this->labelClass ?? 'checkbox-primary'));
			$el->insert(0, $this->getControlPart($key));
			$el->insert(1, $this->getLabelPart($key));

			$htmlItems[$key] = $el;
			$html->addHtml($el);
		}

		return $this->container->setHtml($html);
	}
}
