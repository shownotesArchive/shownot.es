<?php

error_reporting(E_ALL);

include_once ('./OSFphp/osf.php');
include_once ('./OSFphp/parse.php');
include_once ('./easySQL/easysql_sqlite.php');

$sql = './archive.sqlite3';
$dir = './showpad/';
$dh  = scandir($dir);
$i   = 0;

date_default_timezone_set('Europe/Berlin');

function parseUglyDate($str) {
  switch (strlen($str)) {
  case 8:
    if(substr($str,4,4)+0 < 2020 && substr($str,4,4)+0 > 2000 && substr($str,0,2)+0 < 32 && substr($str,2,2)+0 < 13) {
      return strtotime(substr($str,0,2).'.'.substr($str,2,2).'.'.substr($str,4,4));
    } else if(substr($str,0,4)+0 < 2020 && substr($str,0,4)+0 > 2000) {
      return strtotime(substr($str,6,2).'.'.substr($str,4,2).'.'.substr($str,0,4));
    } else {
      return false;
    }
    break;
  case 6:
    if(substr($str,4,2)+0 < 20 && substr($str,4,2)+0 > 0 && substr($str,0,2)+0 < 32 && substr($str,2,2)+0 < 13) {
      return strtotime(substr($str,0,2).'.'.substr($str,2,2).'.20'.substr($str,4,2));
    } else {
      return false;
    }
    break;
  case 5:
    if(substr($str,3,2)+0 < 20 && substr($str,3,2)+0 > 0 && substr($str,0,2)+0 < 32 && substr($str,2,1)+0 > 0) {
      return strtotime(substr($str,0,2).'.'.substr($str,2,1).'.20'.substr($str,3,2));
    } else if(substr($str,3,2)+0 < 20 && substr($str,3,2)+0 > 0 && substr($str,0,2)+0 < 32 && substr($str,0,2)+0 > 0 && substr($str,2,1)+0 > 0) {
      return strtotime(substr($str,0,2).'.'.substr($str,2,1).'.20'.substr($str,3,2));
    } else if(substr($str,3,2)+0 < 20 && substr($str,3,2)+0 > 0 && substr($str,1,2)+0 < 32 && substr($str,1,2)+0 > 0) {
      return strtotime(substr($str,0,1).'.'.substr($str,1,2).'.20'.substr($str,3,2));
    } else {
      return false;
    }
    break;
  case 4:
    if(substr($str,2,2)+0 < 20 && substr($str,2,2)+0 > 0) {
      return strtotime(substr($str,0,1).'.'.substr($str,1,1).'.20'.substr($str,2,2));
    } else {
      return false;
    }
    break;
  default:
    return false;
    break;
  }
  return false;
}

foreach($dh as $file) {
  ini_set('max_execution_time', 120);
  if(is_file('./showpad/'.$file)) {
    $episode[$i]['file']['name'] = $file;
    $episode[$i]['file']['hash'] = hash_file("md5", './showpad/'.$file);
    $episode[$i]['file']['size'] = filesize('./showpad/'.$file);

    $select[0] = $sql;
    $select[1] = 'episodes';
    $select['filename'] = $file;

    $returnarray = easysql_sqlite_select($select, 1);
    if($episode[$i]['file']['hash'] != $returnarray[0]['filehash']) {
      $json = json_decode(file_get_contents('./showpad/'.$file));
      $parsed = parserWrapper($json->text);
      $episode[$i]['podcast'] = trim($parsed['podcast'], " \t\n\r\0\x0B-");
      $episode[$i]['episode'] = ltrim(trim($parsed['episode'], " \t\n\r\0\x0B-"), "0");
      if(preg_match('/\d{2}\.\d{2}\.\d{4}/', $parsed['episode'], $match)) {
        $episode[$i]['episode'] = $match[0];
      } else if($episode[$i]['episode']+0 > 1110) {
        $date = parseUglyDate($episode[$i]['episode']);
        if($date != false) {
          $episode[$i]['episode'] = date("d.m.Y", $date);
        }
      }
      $episode[$i]['shownoter'] = $parsed['shownoter']['data'];
      $episode[$i]['podcaster'] = $parsed['podcaster']['data'];
      $episode[$i]['episodetime'] = $parsed['episodetime'];

      $insertEpisode[0] = $sql;
      $insertEpisode[1] = 'episodes';
      $insertEpisode['filename'] = $file;
      $insertEpisode['podcast'] = $episode[$i]['podcast'];
      $insertEpisode['episode'] = $episode[$i]['episode'];
      $insertEpisode['filehash'] = $episode[$i]['file']['hash'];
      $insertEpisode['episodetime'] = $episode[$i]['episodetime'];
      $insertEpisode['filetime'] = time();
      easysql_sqlite_insert($insertEpisode);
      
      foreach($episode[$i]['shownoter'] as $shownoter) {
        $insertShownoter[0] = $sql;
        $insertShownoter[1] = 'shownoter';
        $insertShownoter['podcast'] = $episode[$i]['podcast'];
        $insertShownoter['episode'] = $episode[$i]['episode'];
        $insertShownoter['shownoter'] = $shownoter['name'];
        $insertShownoter['shownoterurl'] = $shownoter['url'];
        easysql_sqlite_insert($insertShownoter);
      }
      foreach($episode[$i]['podcaster'] as $podcaster) {
        $insertPodcaster[0] = $sql;
        $insertPodcaster[1] = 'podcaster';
        $insertPodcaster['podcast'] = $episode[$i]['podcast'];
        $insertPodcaster['episode'] = $episode[$i]['episode'];
        $insertPodcaster['shownoter'] = $podcaster['name'];
        $insertPodcaster['shownoterurl'] = $podcaster['url'];
        easysql_sqlite_insert($insertPodcaster);
      }
    }
  }
}

?>
