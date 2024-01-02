<?php
    function uploadImage($file, $upload_path, $target_file_name, $size_limit = 2097152) {
        $target_dir = $upload_path;
        $target_file = $target_dir . $target_file_name;
        $upload_error = false;
        $image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $accepted_extensions = array("jpg", "jpeg", "png", "gif");

        mkdir($target_dir, 0777, true);

        if (file_exists($target_file)) {
            $error = "Sorry, file already exists.";
            $upload_error = true;
        }

        if ($file["size"] > $size_limit) {
            $error = "Sorry, your file is too large.";
            $upload_error = true;
        }

        if(!in_array($image_file_type, $accepted_extensions)) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_error = true;
        }

        if (!$upload_error) {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return ["status" => "success", "message" => "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.", "file_path" => $target_file];
            } else {
                return ["status" => "error", "message" => "Sorry, there was an error uploading your file.", ];
            }
        } else {
            return ["status" => "error", "message" => $error];
        }
    }
?>