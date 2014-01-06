#!/usr/bin/php
<?php

error_reporting(0);

include_once ('../OSFphp/osf.php');
include_once ('../OSFphp/parse.php');
include_once ('../easySQL/easysql_sqlite.php');
include_once ('../helper.php');
include_once ('./config.php');

$cache = "./cache/";
$sql = '../archive.sqlite3';
$dir = '../showpad/';
$api = 'http://api.shownot.es/';
$dh  = scandir($dir);
$i   = 0;

if ($argv[0] == '') {
  //browser
  $loadFromServer = $_GET['update'];
  $sendmail = false;
  if ($_GET['debug'] != "") {
    $debug = $_GET['debug'];
  } else {
    $debug = 0;
  }
} else {
  //console
  $loadFromServer = $argv[1];
  if ($argv[2] == true) {
    $sendmail = true;
  }
}

if (($_GET['mode'] == 'accept') || ($_GET['mode'] == 'ignore')) {
  if ($_GET['hash'] == hash("md5", $_GET['episode'].$salt)) {
    if ($_GET['mode'] == 'accept') {
      if (file_exists('../showpad/bak-'.$_GET['episode'].'.json')) {
        echo 'file already exists, deleting old file ... <br/>';
        unlink('../showpad/bak-'.$_GET['episode'].'.json');
      }
      if (file_exists('./cache/bak-'.$_GET['episode'].'.json')) {
        echo 'copy the file ... <br/>';
        copy('./cache/bak-'.$_GET['episode'].'.json', '../showpad/bak-'.$_GET['episode'].'.json');
        importToSQLite('../showpad/', 'bak-'.$_GET['episode'].'.json', $sql);
      } else {
        echo 'error';
      }
    } else {
      $ignore = json_decode(file_get_contents('./ignore.json'));
      print_r($ignore);
      $ignore = $ignore->ignore;
      $ignore[] = hash_file('md5', $cache.'bak-'.$_GET['episode'].'.json');
      $json = array('ignore' => $ignore);
      file_put_contents('./ignore.json', json_encode($json));
      print_r($json);
    }
  } else {
    echo $_GET['hash'] . ' != ' . 'hash( "md5", ' . $_GET['episode'] . ' . ' .$salt . ' ) ';
  }
  exit;
}

date_default_timezone_set('Europe/Berlin');
chmod($cache, 0777);

$allpads = json_decode(file_get_contents($api.'getList/'));
$padarray = array();
$hash = array();
$difflist = array();

unlink($cache.'log.json');
unlink($cache.'diff.json');

if (($loadFromServer == "true") || ($loadFromServer == "rm")) {
  $dirHandle = opendir($cache);
  while ($file = readdir($dirHandle)) {
    if(!is_dir($file) && (substr($file, 0, 1) != '.')) { 
      unlink ($cache.$file);
    }
  }
  closedir($dirHandle); 
}

if ($loadFromServer == "rm") {
  exit;
}

$ignore = json_decode(file_get_contents('./ignore.json'));

foreach ($allpads as $pad) {
  if ($debug < 15) {
    $name = $pad->docname;
    $time = $pad->createTime;
    $podcast = explode('-', $name, 2);
    $episode = $podcast[1];
    $podcast = $podcast[0];

    if ($loadFromServer == "true") {
      $padcontent = file_get_contents('http://api.shownot.es/getPad/?id='.$name);
      if (trim($padcontent) == "") {
        $padcontent = file_get_contents('http://api.shownot.es/getPad/?id='.$name);
      }
      $padcontent = str_replace('\\', '\\\\', $padcontent);
      $padcontent = str_replace(array("\n", '"'), array("\\n", '\"'), $padcontent);
    }

    if ($loadFromServer == "true") {
      $json = '{"name":"'.$name.'","error":null,"text":"'.$padcontent.'"}';
      file_put_contents($cache.'bak-'.$name.'.json', $json);
    }
    $hash[0] = hash_file('md5', $cache.'bak-'.$name.'.json');
    $hash[1] = hash_file('md5', '../showpad/bak-'.$name.'.json');
    $padarray[$name][0] = $hash[0];
    if ($hash[0] != $hash[1]) {
      $padarray[$name][1] = $hash[1];
      if (array_search($hash[0], $ignore->ignore) === false) {
        $difflist[] = $name;
      }
    }
    if ($debug != 0) {
      ++$debug;
    }
  }
}

echo nl2br(json_encode($difflist, JSON_PRETTY_PRINT));

file_put_contents($cache.'log.json', json_encode($padarray, JSON_PRETTY_PRINT));
file_put_contents($cache.'diff.json', json_encode($difflist, JSON_PRETTY_PRINT));

$i = 0;

if ($sendmail == true) {
  $message = "The following Pads are new or have changed:<br/><br/><table>\n\n";
  $headers = 'From: server@shownot.es' . "\r\n" .
  'Reply-To: team@shownot.es' . "\r\n" .
  'MIME-Version: 1.0' . "\r\n" .
  'Content-Type: text/html; charset=ISO-8859-15' . "\r\n" .
  'X-Mailer: snupdate 0.1';

  foreach ($difflist as $pad) {
    if (array_search($padarray[$pad][0], $ignore->ignore) == false) {
      $i++;
      $hash = hash("md5", $pad.$salt);
      $message .= '<tr><td>'.htmlentities($pad).'</td><td><a href="http://archiv.shownot.es/importFromShowpadAPI/preview.php?episode='.$pad.'&mode=block">Block Preview</a></td><td><a href="http://archiv.shownot.es/importFromShowpadAPI/preview.php?episode='.$pad.'&mode=list">List Preview</a></td><td><a href="http://archiv.shownot.es/importFromShowpadAPI/preview.php?episode='.$pad.'&mode=osf">OSF</a></td><td><a href="http://pad.shownot.es/doc/'.$pad.'/readonly#raw">Pad</a></td><td><a href="http://archiv.shownot.es/importFromShowpadAPI/?episode='.$pad.'&hash='.$hash.'&mode=accept">accept</a></td><td><a href="http://archiv.shownot.es/importFromShowpadAPI/?episode='.$pad.'&hash='.$hash.'&mode=ignore">ignore</a>'."</td></tr>\n";
    }
  }

  $message .= "</table><br/>\n".'Generated on '.date('d.m.Y H:i:s')."<br/>\n";
  if($i > 0) {
    echo 'sending email';
    mail('simon@shownot.es', 'daily shownotes update', $message, $headers);
    mail('dr4k3@shownot.es', 'daily shownotes update', $message, $headers);
  }
}

?>
