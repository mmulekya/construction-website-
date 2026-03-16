<?php

function secure_upload($file, $folder){

    $allowed_types = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'application/pdf'
    ];

    $max_size = 5 * 1024 * 1024; // 5MB

    if($file['error'] !== 0){
        return ["error" => "Upload failed."];
    }

    if($file['size'] > $max_size){
        return ["error" => "File too large."];
    }

    $file_type = mime_content_type($file['tmp_name']);

    if(!in_array($file_type, $allowed_types)){
        return ["error" => "Invalid file type."];
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $new_name = bin2hex(random_bytes(16)) . "." . $ext;

    $destination = "uploads/" . $folder . "/" . $new_name;

    if(move_uploaded_file($file['tmp_name'], $destination)){
        return ["success" => $destination];
    }

    return ["error" => "Upload failed."];
}

?>