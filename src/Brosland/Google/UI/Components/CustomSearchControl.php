<?php

namespace Brosland\Google\UI\Components;

class CustomSearchControl extends \Brosland\UI\Control
{
	/**
	 * @var string
	 */
	private $key;
	/**
	 * @var string
	 */
	private $query = NULL;


	/**
	 * @param string $key
	 */
	public function __construct($key)
	{
		parent::__construct();

		$this->key = $key;
	}

	/**
	 * @param string $query
	 */
	public function setQuery($query)
	{
		$this->query = $query;
	}

	protected function renderDefault()
	{
		$this->template->key = $this->key;
		$this->template->query = $this->query;
	}
}

interface ICustomSearchControlFactory
{

	/**
	 * @return \Brosland\Google\UI\Components\CustomSearchControl
	 */
	public function create();
}