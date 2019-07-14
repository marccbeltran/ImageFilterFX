<?php

use Elastica\Client;
use Elastica\Request;
require_once 'vendor/autoload.php';

$tagToFind= $_GET['tags'];


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('dropzone.twig');
echo $twig->render('results.twig', array('queryResult' => searchElastic($tagToFind)));


function searchElastic ($tagToFind) {

$field = 'tags';

$elasticaClient = new Client(array(
    'host' => 'elasticsearch',
    'port' => 9200
));

$client = $elasticaClient;
$index = $client->getIndex('test');
$type = $index->getType('test');

$query = array('query' => array(
    'fuzzy' => array(
        (string)$field => array(// por el campo a buscar en elastic
            'value' => "$tagToFind*",
            'boost' => 2.0,
            'fuzziness' => 2,
            'prefix_length' => 3,
            'max_expansions' => 100
        )
    )));

$path = $index->getName() . '/' . $type->getName() . '/_search';
$response = $elasticaClient->request($path, Request::GET, $query);
$resultArray = $response->getData();

$resultHits = $resultArray['hits']['hits'];

return $resultHits;

}

                    