<?php

namespace Brosland\Google\DI;

use Brosland\Google\UI\Components;

class GoogleExtension extends \Nette\DI\CompilerExtension
{
	/**
	 * @var array
	 */
	private static $DEFAULTS = array (
		'analytics' => '',
		'customSearch' => '',
		'translate' => array (
			'pageLanguage' => 'sk',
			'languages' => array (
				'sk' => 'Slovenčina',
				'en' => 'English',
				'de' => 'Deutsch'
			)
		)
	);


	public function loadConfiguration()
	{
		$extensions = array_filter($this->compiler->getExtensions(), function ($extension)
		{
			return $extension instanceof \Brosland\DI\BroslandExtension;
		});

		if (empty($extensions))
		{
			trigger_error('You should register ' . \Brosland\DI\BroslandExtension::class
				. ' before \'' . get_class($this) . '\'.', E_USER_NOTICE);

			$this->compiler->addExtension('brosland', new \Brosland\DI\BroslandExtension());
		}

		$builder = $this->getContainerBuilder();
		$config = $this->getConfig(self::$DEFAULTS);

		$builder->addDefinition($this->prefix('analyticsControlFactory'))
			->setClass(Components\AnalyticsControl::class)
			->setImplement(Components\IAnalyticsControlFactory::class)
			->setArguments(array ($config['analytics']));

		$builder->addDefinition($this->prefix('customSearchControlFactory'))
			->setClass(Components\CustomSearchControl::class)
			->setImplement(Components\ICustomSearchControlFactory::class)
			->setArguments(array ($config['customSearch']));

		$builder->addDefinition($this->prefix('translateControlFactory'))
			->setClass(Components\TranslateControl::class)
			->setImplement(Components\ITranslateControlFactory::class)
			->setArguments(array (
				$config['translate']['pageLanguage'],
				$config['translate']['languages'],
				$config['analytics']
			));
	}
}