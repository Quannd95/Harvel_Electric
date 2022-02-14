<?php

$root_upload_folder_in_pages = "../../uploads/";

$root_upload_folder = "uploads/";

function checkIfLogin()
{
    session_start();
    if (!isset($_SESSION['isLogin']) && $_SESSION['isLogin']) {
        header('Location: ' . './login.php');
    }
}

function fileFilter($target_file)
{
    if (file_exists($target_file)) {
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $target_name = basename($target_file, "." . $imageFileType);
        $folder = str_replace(basename($target_file), "", $target_file);
        $range = 0;

        $final_target_file = null;
        do {
            $range += 1;
            $final_target_file = $folder . $target_name . rand($range, $range * 10) . "." . $imageFileType;
        } while (file_exists($final_target_file));

        $new_target_name = basename($final_target_file);
        return ['target_file' => $final_target_file, 'file_name' => $new_target_name];
    } else {
        $target_name = basename($target_file);
        return ['target_file' => $target_file, 'file_name' => $target_name];
    }
}
