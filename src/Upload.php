<?php

namespace Rorikurn\GoogleSpeechClient;


use Google\Cloud\Speech\SpeechClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\ExponentialBackoff;


class Upload {

	private $speech;

	private $storage;

	private $speechOptions = [
	    'encoding' => 'LINEAR16',
	    'sampleRateHertz' => 16000,
	];

	private $porjectId = 'speech-to-text-project-163409';

	private $bucketName = 'testbucket909';

	protected $results = [];

	public function __construct($file)
	{
		$this->speech = new SpeechClient([
		    'projectId' => $this->porjectId,
		    'languageCode' => 'en-US',
		]);

		$this->storage = new StorageClient([
		    'projectId' => $this->porjectId,
		]);
	}

	/**
	 * Check Audio File for FLAC
	 * 
	 * @param   $file
	 * @return boolean
	 */
	public function checkFile($file)
	{
		return true;
	}

	/**
	 * Convert To Flac
	 * 
	 * @param $file
	 * @return 
	 */
	public function convertToFlac($file)
	{

	}

	public function process($file)
	{
		if (!$this->checkFile($file)) {
			$file = $this->convertToFlac($file);
		}
	    // fetch the storage object
	    $object = $this->storage->bucket($this->bucketName)->object($file);

	    $operation = $this->speech->beginRecognizeOperation(
	        $object,
	        $this->speechOptions
	    );
	    $backoff = new ExponentialBackoff(10);
	    $backoff->execute(function () use ($operation) {
	        print('Waiting for operation to complete' . PHP_EOL);
	        $operation->reload();
	        if (!$operation->isComplete()) {
	            throw new Exception('Job has not yet completed', 500);
	        }
	    });

	    if ($operation->isComplete()) {
	        if (empty($results = $operation->results())) {
	            $results = $operation->info();
	        }
	        $this->results[] = $results;
	    }
	}
}
