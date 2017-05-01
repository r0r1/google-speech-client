<?php
require __DIR__ . '/../vendor/autoload.php';

$fileName = __DIR__ . '/../public/big.wav';
$fileName = fopen($fileName, 'r');

$upload = new Rorikurn\GoogleSpeechClient\Upload($fileName);
$upload->process($fileName);
