<?php
require_once 'vendor/autoload.php';
require_once 'sys/start.php';

/**************************************************** */

if (!file_exists('file.xml')) {
  $doc = new DOMDocument('1.0');
  $doc->formatOutput = true;
  $root = $doc->createElement('root');
  $root = $doc->appendChild($root);
  $userElement = $doc->createElement('user');
  $userElement = $root->appendChild($userElement);
  $userElement = $doc->createElement('user');
  $userElement = $root->appendChild($userElement);
  $doc->save('file.xml');
}

$xml = simplexml_load_file("file.xml");
$users = (array) $xml;

$users['user'][] = [
  'DataDeInício' => 'value 1',
  'key2' => 'value 2',
  'key3' => 'value 3'
];

$doc = new DOMDocument('1.0');
$doc->formatOutput = true;
$root = $doc->createElement('root');
$root = $doc->appendChild($root);
foreach ($users['user'] as $user) {
  $userElement = $doc->createElement('user');
  $userElement = $root->appendChild($userElement);
  foreach($user as $key => $value) {
    $em = $doc->createElement((string) $key);       
    $text = $doc->createTextNode((string) $value);
    $em->appendChild($text);
    $userElement->appendChild($em);
  }
}
$doc->save('file.xml');