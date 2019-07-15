<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

function sendQueue($mensaje){

$connection = new AMQPConnection('rabbitmq', 5672, 'rabbitmq', 'rabbitmq');
$channel = $connection->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);

$data = $mensaje;

$msg = new AMQPMessage(
    $data
);

$channel->basic_publish($msg, 'logs');

echo " [x] Sent ", $data, "\n";

$channel->close();
$connection->close();

}

?>
