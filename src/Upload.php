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
	    'sampleRateHertz' => 8000,
	];

	private $projectId = 'speech-to-text-project-163409';

	private $bucketName = 'testbucket909';

	protected $results;

	public function __construct($file)
	{
		$this->speech = new SpeechClient([
		    'projectId' => $this->projectId,
		    'languageCode' => 'en-US',
		]);

		$this->storage = new StorageClient([
		    'projectId' => $this->projectId,
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
	    $fileName = $file['name'];
	    $object = $this->storage->bucket($this->bucketName)->object($fileName);

	    $operation = $this->speech->beginRecognizeOperation(
	        $object,
	        $this->speechOptions
	    );
	    $backoff = new ExponentialBackoff(10);
	    $backoff->execute(function () use ($operation) {
	        $operation->reload();
	        if (!$operation->isComplete()) {
	            throw new \Exception('Job has not yet completed', 500);
	        }
	    });

	    if ($operation->isComplete()) {
	    	if (empty($results = $operation->results())) {
	            $results = $operation->info();
	        }

	        $this->results = $results;
	        return true;
	    }

	    return false;
	}

	public function generateResult()
	{
		$speechResult = new \ReflectionMethod('Google\Cloud\Speech\Result', 'info');
		$speechResult->setAccessible(true);

		$text = [];
		foreach ($this->results as $key => $result) {
			$response = $speechResult->invoke($result);
			$text[] = $response['alternatives'][0]['transcript'];
		}

		return $text;
	}
}
