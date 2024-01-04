<?php
    function deleteImage($file_path) {
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
?>