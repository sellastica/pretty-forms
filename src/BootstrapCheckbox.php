<?php
namespace Sellastica\PrettyForms;

use Nette\Forms\Controls\Checkbox;
use Nette\Utils\Html;

class BootstrapCheckbox extends Checkbox
{
	/** @var string|null */
	private $labelClass;
	/** @var string|null */
	private $tooltipTitle;
	/** @var string|null */
	private $tooltipDescription;


	/**
	 * @param null|string $class
	 * @return $this
	 */
	public function setLabelClass(?string $class): BootstrapCheckbox
	{
		$this->labelClass = $class;
		return $this;
	}

	/**
	 * @param string $title
	 * @param string $description
	 * @return BootstrapCheckbox
	 */
	public function setTooltip(string $title, string $description): BootstrapCheckbox
	{
		$this->tooltipTitle = $title;
		$this->tooltipDescription = $description;
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

		if (isset($this->tooltipTitle)
			&& isset($this->tooltipDescription)) {
			$el->insert(2, Html::el('i')
				->setAttribute('class', 'fa fa-question-circle advanced-tooltip ml-5')
				->data('original-title', $this->tooltipTitle)
				->data('content', $this->tooltipDescription)
				->data('toggle', 'popover')
				->data('container', 'body')
				->data('html', '1')
			);
		}

		return $el;
	}
}
