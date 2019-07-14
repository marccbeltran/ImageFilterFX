<?php


require 'vendor/autoload.php';
require_once 'insertDb.php';
require_once 'elastic.php';



use claviska\SimpleImage;



function imageFx4 ($image){

   
    global $redis;

    $milliseconds = round(microtime(true) * 1000);

    $imgName = $milliseconds+400;

    $img = new SimpleImage($image);
    $file = './uploads/'.$imgName.'.gif';
    $img->pixelate()   ->toFile($file);
    $tagsFx = 'pixelate';


    insertDb($file, $tagsFx);


    $redis = new Redis();
    $redis->connect('redis');

    
    $sql = "SELECT * FROM images_info ORDER BY image_id DESC";
    $query = (mysqli_query(dbConnect(),$sql));
    $rows = array();

        while($r = mysqli_fetch_assoc($query)) {
            $rows[] = $r;
        }

        $redis->set('images',json_encode($rows));
          

    elasticaInsert($file, $tagsFx);

}


