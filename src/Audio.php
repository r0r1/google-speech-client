<?php

namespace Rorikurn\GoogleSpeechClient;

class Audio {

	private $name;

	public function __construct($fileName)
	{
		$this->setName($fileName);
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function checkFile()
	{
		
	}
}