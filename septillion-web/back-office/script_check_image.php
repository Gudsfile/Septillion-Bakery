<?php
/* Checks if required PHP extensions are loaded. Tries to load them if not */
function check_php_extensions(){
  if (!extension_loaded('fileinfo')) {
    if(function_exists('dl')){
      if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        if (!dl('fileinfo.dll')) {
          return false;
        } else {
          return true;
        }
      } else {
        if (!dl('fileinfo.so')) {
          return false;
        } else {
          return true;
        }
      }
    } else {
      return false;
    }
  } else {
    return true;
  }
}

/* Checks the true mime type of the given file */
function check_image_mime($tmpname){
  $finfo = finfo_open( FILEINFO_MIME_TYPE );
  $mtype = finfo_file( $finfo, $tmpname );

  if(strpos($mtype, 'image/') === 0){
    return true;
  } else {
    return false;
  }
  finfo_close( $finfo );
}

/* Checks if the image isn't to large */
function check_image_size($tmpname, $max_size){
  if(filesize($tmpname) > $max_size){
    return false;
  } else {
    return true;
  }
}

function check_image($file, $max_size){
	// Checks if the required PHP extension(s) are loaded
	if(check_php_extensions()){
    // Checks the true MIME type of the file
    if(check_image_mime($file)){
      // Checks the size of the the image
      if(check_image_size($file, $max_size)){
        return 0;
      } else {
        return 2;
      }
    } else {
      return 3;
    }
  } else {
    return 4;
  }
}
?>
