<?php
namespace Sellastica\Forms;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\CheckboxList;
use Nette\Utils\Html;

class PrettyCheckboxList extends CheckboxList
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
		$input = BaseControl::getControl();
		$items = $this->getItems();
		reset($items);

		$htmlItems = [];
		foreach ($this->translate($items) as $key => $item) {
			$htmlItems[$key] = Html::el()->addText($item);
			$htmlItems[$key]->addHtml(Html::el('div')->class('control-indicator'));
		}

		$labelAttributes = (array)$this->itemLabel ? $this->itemLabel->attrs : $this->label->attrs;
		$labelAttributes = array_merge($labelAttributes, ['class' => 'control input-checkbox']);
		return $this->container->setHtml(
			\Nette\Forms\Helpers::createInputList(
				$htmlItems,
				array_merge($input->attrs, [
					'id' => null,
					'checked?' => $this->value,
					'disabled:' => $this->disabled,
					'required' => null,
					'data-nette-rules:' => [key($items) => $input->attrs['data-nette-rules']],
				]),
				$labelAttributes,
				$this->separator
			)
		);
	}
}
