<?php


require 'vendor/autoload.php';
require 'db.php';
require 'elastic.php';


$redis = new Redis();
$redis->connect('redis');


//echo "<div style='background: lightgrey'>REDIS CONNECTION IS RUNNING, PING: " . $redis->ping() . " - " . "PLEASE, SET TAGS BEFORE UPLOAD THE PICTURES</div> ";


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('dropzone.twig');
echo $twig->render('dropzone.twig', array('queryResult' => getData()));


function getData()
{

    global $redis;

    if ($redis->exists("images")) {
        echo "<font color='#5BC0DE'> [ DATA FROM REDIS ]</font>";
        return dataFromRedis();
    
    } else {
        echo "<font color='red'> [ DATA FROM SQL DATABASE ]</font>";
        return dataFromMySql();
          
    }
    
}


function dataFromRedis(){
    global $redis;
    $data = json_decode($redis->get('images'), true);
    return $data;
}

function dataFromMySql(){
    $sql = "SELECT * FROM images_info ORDER BY image_id DESC";
    $query = (mysqli_query(dbConnect(), $sql));
    $rows = array();
    while ($r = mysqli_fetch_assoc($query)) {
        $rows[] = $r;
    }
    return $rows;
}

