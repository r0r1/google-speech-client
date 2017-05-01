<?php

namespace Rorikurn\GoogleSpeechClient;

class Audio {

	private $name;

	public function __construct($fileName)
	{
		$this->setName($fileName);
	}

	/**
	 * Set Name
	 * 
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Get name
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}