<?php
namespace Sellastica\Forms;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\Checkbox;
use Nette\Utils\Html;

class PrettyCheckbox extends Checkbox
{
	/** @var string|null */
	private $labelClass;


	/**
	 * @param null|string $class
	 * @return $this
	 */
	public function setLabelClass(?string $class)
	{
		$this->labelClass = $class;
		return $this;
	}

	/**
	 * @return Html
	 */
	public function getLabelPart(): Html
	{
		return BaseControl::getLabel()
			->setClass('control input-checkbox' . ($this->labelClass ? " $this->labelClass" : ''))
			->insert(0, Html::el('div')
				->setClass('control-indicator'));
	}
}
