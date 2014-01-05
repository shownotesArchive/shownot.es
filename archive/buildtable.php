<?php

error_reporting(E_ALL);

include_once ('./OSFphp/osf.php');
include_once ('./OSFphp/parse.php');
include_once ('./easySQL/easysql_sqlite.php');
//include_once ('./config.php');
include_once ('./helper.php');

$sql = './archive.sqlite3';
$dir = './showpad/';
$dh  = scandir($dir);
$i   = 0;

date_default_timezone_set('Europe/Berlin');
chmod($sql, 0777);

$starttime = time();
rename('./cache/osf/', './cache/'.$starttime.'/');

foreach($dh as $file) {
  ini_set('max_execution_time', 120);
  echo $file."<br/>";
  if(is_file($dir.$file)) {
    flush();
    usleep(30000);
    importToSQLite('./showpad/', $file, $sql);
  }
}

?>
