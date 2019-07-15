<?php

use Elastica\Client;
use Elastica\Document;

require_once 'vendor/autoload.php';


function elasticaInsert($path, $tags){

$elasticaClient = new Client(array(
    'host' => 'elasticsearch',
    'port' => 9200
));


$id=uniqid('id_', false);

$image = array(
    'id'   => $id,
    'path' => $path,
    'tags' => $tags   
);

$imageDocument = new Document($id, $image);

$client = $elasticaClient;
$index = $client->getIndex('test');
$index->create(array(), true);  //comentar si se ha generado el indice
$type = $index->getType('test');
$type->addDocument($imageDocument);
$index->refresh();
		{
			var_dump('Insert success');
        }

}
