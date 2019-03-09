<?php
namespace Sellastica\PrettyForms;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\RadioList;
use Nette\Utils\Html;

class BootstrapRadioList extends RadioList
{
	/**
	 * @param string|object
	 * @param array|null $items
	 */
	public function __construct($label = null, array $items = null)
	{
		parent::__construct($label, $items);
	}

	/**
	 * Generates control's HTML element.
	 * @return Html
	 */
	public function getControl(): Html
	{
		$input = BaseControl::getControl();
		$items = $this->getItems();

		$html = Html::el();
		$htmlItems = [];
		foreach ($this->translate($items) as $key => $item) {
			$id = $input->id . '-' . $key;
			$div = Html::el('div')->setAttribute('class', 'radio radio-primary');
			$div->addHtml(Html::el('input')
				->addAttributes(array_merge($input->attrs, [
					'id' => $id,
					'checked' => $key === $this->value,
					'disabled' => $this->disabled,
					'data-nette-rules:' => [key($items) => $input->attrs['data-nette-rules']],
				])));

			$label = Html::el('label')
				->addAttributes(['for' => $id] + $this->itemLabel->attrs)
				->addText($item);
			$div->addHtml($label);

			$htmlItems[$key] = $div;
			$html->addHtml($div);
		}

		return $this->container->setHtml($html);
	}
}
