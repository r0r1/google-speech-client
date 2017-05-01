<?php

namespace Rorikurn\GoogleSpeechClient;

class ConvertFile {

	private $file;

	public function __construct($file)
	{
		$this->file = $file;
	}

	/**
	 * Validate File must be `audio/*` type
	 * 
	 * @return boolean
	 */
	public function validate()
	{
		return true;
	}

	/**
	 * Check file must be `audio/flac`
	 * 
	 * @return boolean
	 */
	private function check()
	{
		return true;
	}

	/**
	 * Convert file to flac
	 * 
	 * @return $file
	 */
	public function process()
	{
		return $this->file;
	}
}
