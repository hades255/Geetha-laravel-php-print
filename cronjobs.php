<?php
// Define the function to clean up files
function cleanOldReports() {
    
    $age = 3600;
    
    $path = __DIR__ ."/reports";
    
    
    $current_time = time();
    
    $dir_handle = opendir($path);

    while (($file = readdir($dir_handle)) !== false) {
        $file_path = $path . '/' . $file;

        if (is_file($file_path) && ($current_time - filemtime($file_path) > $age)) {
            // Delete the file
            unlink($file_path);
        }
    }

    
    closedir($dir_handle);
}



if (php_sapi_name() == 'cli') {
    
    $args = $argv;
    
    if ($args[1] == 'cleanOldReport') {
        cleanOldReports();
    } 
}
?>
