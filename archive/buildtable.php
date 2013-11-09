<?php

error_reporting(E_ALL);

include_once ('./osf/osf.php');
include_once ('./osf/parse.php');
include_once ('./easySQL/easysql_sqlite.php');

$dir = './showpad/';
$dh  = scandir($dir);
$i   = 0;

foreach($dh as $file) {
  if(is_file('./showpad/'.$file)) {
    $episode[$i]['file']['name'] = $file;
    $episode[$i]['file']['hash'] = hash_file("md5", './showpad/'.$file);
    $episode[$i]['file']['size'] = filesize('./showpad/'.$file);
    
    $select[0] = './archive.sqlite3';
    $select[1] = 'episodes';
    $select['filename'] = $file;

    $returnarray = easysql_sqlite_select($select, 1);
    if($episode[$i]['file']['hash'] != $returnarray[0]['filehash']) {
      $json = json_decode(file_get_contents('./showpad/'.$file));
      $parsed = parseWrapper($json->text);
      $episode[$i]['podcast'] = trim($parsed['podcast'], " \t\n\r\0\x0B-");
      $episode[$i]['episode'] = ltrim(trim($parsed['episode'], " \t\n\r\0\x0B-"), "0");
      $episode[$i]['shownoter'] = $parsed['shownoter'];
      $episode[$i]['podcaster'] = $parsed['podcaster'];
      $episode[$i]['episodetime'] = $parsed['episodetime'];
      
      $insert[0] = './archive.sqlite3';
      $insert[1] = 'episodes';
      $insert['filename'] = $file;
      $insert['podcast'] = $episode[$i]['podcast'];
      $insert['episode'] = $episode[$i]['episode'];
      $insert['filehash'] = $episode[$i]['file']['hash'];
      $insert['episodetime'] = $episode[$i]['episodetime'];
      $insert['filetime'] = time();
      
      $rowid = easysql_sqlite_insert($insert);
      #echo $rowid;
    }
    $i++;
  }
}

?>
