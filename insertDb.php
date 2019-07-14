<?php

require 'vendor/autoload.php';
require 'db.php';

function insertDb($file, $tagsFx){

$sql = "INSERT INTO images_info (image_path,tags) VALUES ('" . $file . "','" . $tagsFx . "')";
mysqli_query(dbConnect(), $sql); 


}

