<?php

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

function importToSQLite($dir, $file, $sql) {
  $episode['file']['name'] = $file;
  $episode['file']['hash'] = hash_file("md5", $dir.$file);
  $episode['file']['size'] = filesize($dir.$file);

  $select[0] = $sql;
  $select[1] = 'episodes';
  $select['filename'] = $file;

  $returnarray = easysql_sqlite_select($select, 1);
  if(($episode['file']['hash'] != $returnarray[0]['filehash'])&&($episode['file']['size'] > 400)) {
    echo "<br/>file has changed...<br/>";
    $now = time();
    $json = json_decode(file_get_contents($dir.$file));
    $parsed = parserWrapper($json->text);
    $episode['podcast'] = trim($parsed['podcast'], " \t\n\r\0\x0B-");
    $episode['episode'] = ltrim(trim($parsed['episode'], " \t\n\r\0\x0B-"), "0");
    if(preg_match('/\d{2}\.\d{2}\.\d{4}/', $parsed['episode'], $match)) {
      $episode['episode'] = $match[0];
    } else if($episode['episode']+0 > 1110) {
      $date = parseUglyDate($episode['episode']);
      if($date != false) {
        $episode['episode'] = date("d.m.Y", $date);
      }
    }
    $episode['shownoter'] = $parsed['shownoter']['data'];
    $episode['podcaster'] = $parsed['podcaster']['data'];
    $episode['episodetime'] = $parsed['episodetime'];
    $episode['subject'] = $parsed['subject'];
    mkdir($dir.'../cache/osf/', 0777);
    file_put_contents($dir.'../cache/osf/'.$episode['podcast'].'_'.$episode['episode'].'.osf.txt', $parsed['osf']);
    
    $insertEpisode = array();
    $insertEpisode[0] = $sql;
    $insertEpisode[1] = 'episodes';
    $insertEpisode['filename'] = $file;
    $insertEpisode['podcast'] = $episode['podcast'];
    $insertEpisode['episode'] = $episode['episode'];
    $insertEpisode['filehash'] = $episode['file']['hash'];
    $insertEpisode['episodetime'] = $episode['episodetime'];
    $insertEpisode['subject'] = $episode['subject'];
    $insertEpisode['filetime'] = $now;
    $insertEpisode['filesize'] = $episode['file']['size'];
    easysql_sqlite_insert($insertEpisode);
    print_r($insertEpisode);

    foreach($episode['shownoter'] as $shownoter) {
      $insertShownoter = array();
      $insertShownoter[0] = $sql;
      $insertShownoter[1] = 'shownoter';
      $insertShownoter['podcast'] = $episode['podcast'];
      $insertShownoter['episode'] = $episode['episode'];
      $insertShownoter['shownoter'] = $shownoter['name'];
      $insertShownoter['shownoterurl'] = $shownoter['url'];
      easysql_sqlite_insert($insertShownoter);
    }
    foreach($episode['podcaster'] as $podcaster) {
      $insertPodcaster = array();
      $insertPodcaster[0] = $sql;
      $insertPodcaster[1] = 'podcaster';
      $insertPodcaster['podcast'] = $episode['podcast'];
      $insertPodcaster['episode'] = $episode['episode'];
      $insertPodcaster['podcaster'] = $podcaster['name'];
      $insertPodcaster['podcasterurl'] = $podcaster['url'];
      easysql_sqlite_insert($insertPodcaster);
    }
  }
}

?>