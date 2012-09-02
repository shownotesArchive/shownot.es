<?php
$podcast_name = $_GET['pc'];
if(isset($_GET['pc']) && 1 === preg_match('/^[a-zA-Z0-9_-]{1,16}$/', $podcast_name)) {
  $podcast_folder = 'podcasts/' . $podcast_name;
  if(is_dir($podcast_folder)) {
    $files_in_folder;
    if(isset($_GET['desc'])) {
//requires PHP >= 5.4.0
//      $files_in_folder = scandir($podcast_folder, SCANDIR_SORT_DESCENDING);
      $files_in_folder = array_reverse(scandir($podcast_folder));
    } else {
      $files_in_folder = scandir($podcast_folder);
    }
    $first_file = TRUE;
    echo "{ ";

    foreach($files_in_folder as $file_name) {
      if("." == $file_name || ".." == $file_name) {
        continue;
      } else {
        if($first_file) {
          $first_file = FALSE;
        } else {
          echo ", ";
        }
        echo "\"" . $podcast_folder . "/" . $file_name . "\"";
      }
    }
    echo "};";
  }
} else {
  header('HTTP/1.1 400 Bad Request');
  echo "{ \"Please specify a GET parameter consisting of 1 to 16 characters out of a-z A-Z 0-9 _ -\" }";
}


?>