<?php

require_once 'publisher.php';
require_once 'insertDb.php';
require_once 'elastic.php';




if (! empty($_FILES)) {

    

    $imagePath = isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"] : "Undefined";
    $targetPath = "./uploads/";
    $imagePath = $targetPath . $imagePath;


    $tempFile = $_FILES['file']['tmp_name'];
    $targetFile = $targetPath . $_FILES['file']['name'];

    move_uploaded_file($tempFile, $targetFile);

    $tags= $_POST['tags'];


    insertDb($imagePath, $tags);
    sendQueue($imagePath);
    elasticaInsert($imagePath,$tags);


}

