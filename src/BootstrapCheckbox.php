<?php
namespace Sellastica\PrettyForms;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\Checkbox;
use Nette\Utils\Html;

class BootstrapCheckbox extends Checkbox
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
	 * Generates control's HTML element.
	 * @return Html
	 */
	public function getControl()
	{
		$el = Html::el('div')->setAttribute('class', 'checkbox ' . ($this->labelClass ?? 'checkbox-primary'));
		$el->insert(0, $this->getControlPart());
		$el->insert(1, $this->getLabelPart());

		return $el;
	}
}
