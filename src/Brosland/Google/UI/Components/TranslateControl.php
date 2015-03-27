<?php

namespace Brosland\Google\UI\Components;

use Nette\Utils\Html;

class TranslateControl extends \Brosland\Application\UI\Control
{
	/**
	 * @var string
	 */
	private $pageLanguage;
	/**
	 * @var string
	 */
	private $currentLanguage;
	/**
	 * @var array
	 */
	private $languages;
	/**
	 * @var Html
	 */
	private $customButton = NULL;
	/**
	 * @var string
	 */
	private $googleAnalyticsKey = NULL;


	/**
	 * @param string $pageLanguage
	 * @param array $languages
	 * @param string|NULL $googleAnalyticsKey
	 */
	public function __construct($pageLanguage, array $languages, $googleAnalyticsKey = NULL)
	{
		parent::__construct();

		$this->pageLanguage = $this->currentLanguage = $pageLanguage;
		$this->languages = $languages;
		$this->googleAnalyticsKey = $googleAnalyticsKey;
	}

	/**
	 * @param string $currentLanguage
	 */
	public function setCurrentLanguage($currentLanguage)
	{
		$this->currentLanguage = empty($currentLanguage) ? $this->pageLanguage : $currentLanguage;
	}

	/**
	 * @param Html|NULL $customButton
	 */
	public function setCustomButton(Html $customButton = NULL)
	{
		$this->customButton = $customButton;
	}

	protected function renderDefault()
	{
		$button = $this->customButton ? $this->customButton : Html::el('a')->setText('Language');
		$button->class[] = 'dropdown-toggle';
		$button->addAttributes(array (
			'id' => $this->getUniqueId() . '-label',
			'href' => '#',
			'data-toggle' => 'dropdown',
			'aria-haspopup' => 'true'
		));

		$this->template->button = $button;
		$this->template->pageLanguage = $this->pageLanguage;
		$this->template->currentLanguage = $this->currentLanguage;
		$this->template->languages = $this->languages;
		$this->template->googleAnalyticsKey = $this->googleAnalyticsKey;
	}
}

interface ITranslateControlFactory
{

	/**
	 * @return \Brosland\Google\UI\Components\TranslateControl
	 */
	public function create();
}