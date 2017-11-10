<?php
namespace Sellastica\Forms\DI;

use Nette\DI\CompilerExtension;
use Nette\Forms\Container;
use Nette\PhpGenerator\ClassType;
use Nette\Utils\ObjectMixin;
use Sellastica;

class FormsExtension extends CompilerExtension
{
	public function afterCompile(ClassType $class)
	{
		$init = $class->getMethods()['initialize'];
		$init->addBody(__CLASS__ . '::registerControls();');
	}

	public static function registerControls()
	{
		//checkbox
		ObjectMixin::setExtensionMethod(Container::class, 'addPrettyCheckbox', function (Container $container, $name, $label = null) {
			return $container[$name] = new Sellastica\Forms\PrettyCheckbox($label);
		});
		//checkbox list
		ObjectMixin::setExtensionMethod(Container::class, 'addPrettyCheckboxList', function (Container $container, $name, $label = null, array $items = null) {
			return $container[$name] = new Sellastica\Forms\PrettyCheckboxList($label, $items);
		});
		//radio list
		ObjectMixin::setExtensionMethod(Container::class, 'addPrettyRadioList', function (Container $container, $name, $label = null, array $items = null) {
			return $container[$name] = new Sellastica\Forms\PrettyRadioList($label, $items);
		});
	}
}