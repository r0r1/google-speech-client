<?php

namespace Rorikurn\GoogleSpeechClient\Config;

return [
	'project_id'	=> ''
	'speech'	=> [
		'language_code'	=> '',
		'options'	=> [
			'encoding' => 'LINEAR16',
	    	'sampleRateHertz' => 8000,
		]
	],
	'storage'	=> [
		'bucket_name'	=> ''
	]
]