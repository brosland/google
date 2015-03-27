<?php

namespace Brosland\Google\UI\Components;

class AnalyticsControl extends \Brosland\Application\UI\Control
{
	/**
	 * @var string
	 */
	private $key;


	/**
	 * @param string $key
	 */
	public function __construct($key)
	{
		parent::__construct();

		$this->key = $key;
	}

	protected function renderDefault()
	{
		$this->template->key = $this->key;
	}
}

interface IAnalyticsControlFactory
{

	/**
	 * @return \Brosland\Google\UI\Components\AnalyticsControl
	 */
	public function create();
}