<?php
namespace Sellastica\Forms;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\RadioList;
use Nette\Utils\Html;

class PrettyRadioList extends RadioList
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
		$ids = [];
		if ($this->generateId) {
			foreach ($items as $value => $label) {
				$ids[$value] = $input->id . '-' . $value;
			}
		}

		$htmlItems = [];
		foreach ($this->translate($items) as $key => $item) {
			$htmlItems[$key] = Html::el()->addText($item);
			$htmlItems[$key]->addHtml(Html::el('div')->class('control-indicator'));
		}

		$labelAttributes = ['for:' => $ids] + $this->itemLabel->attrs;
		$labelAttributes = array_merge($labelAttributes, ['class' => 'control input-radio']);

		return $this->container->setHtml(
			\Nette\Forms\Helpers::createInputList(
				$htmlItems,
				array_merge($input->attrs, [
					'id:' => $ids,
					'checked?' => $this->value,
					'disabled:' => $this->disabled,
					'data-nette-rules:' => [key($items) => $input->attrs['data-nette-rules']],
				]),
				$labelAttributes,
				$this->separator
			)
		);
	}
}
