<?php
$target_dir = "img/";
$file = $_FILES[$file];
$uploadOk = 1;
$imagensubida = "";

// Check file size
if ($file["size"] > 500000) {
    echo "Lo siento, la imagen es demasiado grande.";
    $uploadOk = 0;
}

// Allow certain file formats
$imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    $nombre = isset($nombre)&&$nombre?$nombre:uniqid();
    $extension = $extension??$imageFileType;
    $target_file = $target_dir . $nombre.".".$extension;
    // Check if file already exists
    if (file_exists($target_file)) {
        unlink($target_file);
    }
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded.";
        $imagensubida = "$nombre.$extension";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
