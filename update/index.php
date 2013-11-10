<?php

include './cache.php';

if(!isset($_GET['preview'])) {
  if (!$handle = fopen($filename, 'w')) {
    echo 'Cannot open file '.$filename."<br/>\n";
    exit;
  } else {
    echo 'open file: success'."<br/>\n";
    @sleep(1);
  }

  if (fwrite($handle, $inhalt) === FALSE) {
    echo 'Cannot write to file '.$filename."<br/>\n";
    exit;
  } else {
    echo 'write file: success'."<br/>\n";
    @sleep(1);
  }
  fclose($handle);

  @sleep(1);
  echo 'finish'."<br/>\n";
} else {
  echo $inhalt."<br/>\n";
  @sleep(1);
}

?>