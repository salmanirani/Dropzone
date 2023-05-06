<?php

// Include the database configuration file
include_once 'dbConfig.php';

if (!empty($_FILES['file']['name'])) {

    $file_name = "";

    $totalFile = count($_FILES['file']['name']);

    for ($i=0; $i < $totalFile ; $i++) {

        $fileName = $_FILES['file']['name'][$i];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowExtn = array('png', 'jpeg', 'jpg');

        if (in_array($extension, $allowExtn)) {
            $newName = rand() . ".". $extension;
            $uploadFilePath = "uploads/".$newName;
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);
            $file_name .= $newName ." , ";
        }
    }
    //Insert file information in the database
    $query = "INSERT INTO files (file_name, created) VALUES ('$file_name', NOW())";
    if ($con->query($query)) {
        echo "true";
    }else{
        echo "false";
    }
}

?>