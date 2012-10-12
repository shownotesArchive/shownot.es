<?php
@sleep(1);
$starttime = microtime(1);
ob_start();

function getEpisodes($Podcast, $count)
  {
    if ($handle = @scandir('./../podcasts/'.$Podcast, 1))
      {
        foreach($handle as $file)
          {
            if ($file != "." && $file != "..")
              {
                $Episode = explode('.', $file);
                if($Episode[2] != '')
                  {
                    $linkname = str_replace('_', '.', $Episode[1]);
                    $link = 'http://shownot.es/'.$Podcast.'/'.$Episode[0];
                    echo '<li><a onclick="TINY.box.show({url:\'./podcasts/'.$Podcast.'/'.$file.'\'}); return false" href="'.$link.'">'.$linkname.'</a></li>';
                    ++$count;
                  }
              }
          }
      }
    else
      {
        echo "<li>Verzeichnis leer</li>";
      }
    return $count;
  }

?><!DOCTYPE html>
<html lang="de"> 
<head>
  <meta charset="utf-8" />
  <title>Die Shownotes</title>
  <meta name="viewport" content="width=980" />  
  <meta name="apple-mobile-web-app-capable" content="yes" />  
  <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
  <link rel="icon" type="image/x-icon" href="./favicon.ico" />
  <link rel="stylesheet" href="http://cdn.shownot.es/baf/css/baf.min.css?v=004" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/style.min.css?v=004" type="text/css" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/anycast.min.css?v=004" type="text/css"  media="screen" />
  <link rel="apple-touch-startup-image" href="http://cdn.shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://cdn.shownot.es/img/iPadPortait.png" />
  <script>
    
    function loadShownotes()
      {
        if(window.location.hash)
        {
          var hashvar = window.location.hash.replace('#', '');
          hashvar = hashvar.replace('-', '/');
          TINY.box.show({url:'./'+hashvar+'&clear=true'});
        }
      }
    
  </script>
  <script src="http://cdn.shownot.es/js/jquery.min.js"></script>
  <style>
  dl {
  padding: 40px 80px 30px 120px;
  background: #FEFEFE;
  width: 799px;
  margin-left: -15px;
  float: none;
  border-radius: 5px;
  }
  </style>
</head>
<body onload="loadShownotes();">
<div class="content">
  <div class="header">
    <div class="title"><a href="/"><img src="http://cdn.shownot.es/img/logo.png">Die Shownotes</a></div>
  </div>
  <div class="box" id="main">
    <div class="title">Hallo!</div>
    <p style="margin-top: 1em;">
      Wir sind eine Community, die Shownotes f&uuml;r verschiedene Podcast- und Radioformate live mitnotiert. Du befindest dich gerade auf unserer tempor&auml;ren &Uuml;bergangsseite. Wir planen momentan, eine eigene Software zu modifizieren und in Betrieb zu nehmen, um das Schreiben von Shownotes zu erleichtern. <a href="http://i.minus.com/jcoBKNlPtJ5Lp.png">Hier</a> dazu eine kleine Vorschau. Bis dahin erreicht ihr die Pads nach wie vor &uuml;ber <a href="https://shownotes.piratenpad.de/"><strong>shownotes.piratenpad.de</strong></a>.
    </p><hr><br>
    <div id="podcasts">
      <p style="margin-top: 1em;">
        Wir schreiben aktuell f&uuml;r folgende Podcasts mehr oder weniger regelm&auml;ßig die Shownotes:
      </p>
      <div style="margin-top: 1em;">
        <div class="baf-group">
          <a class="baf" href="http://www.wrint.de/">WRINT</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('wrint', 0); ?>
          </ul>
        </div>
        <div class="baf-group">
          <a class="baf" href="http://www.fritz.de/media/podcasts/sendungen/blue_moon.html">Blue&nbsp;Moon</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('bm', $i); ?>
          </ul>
        </div>
        <div class="baf-group">
          <a class="baf" href="http://blogs.hr-online.de/lateline/podcast/">LateLine</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('ll', $i); ?>
          </ul>
        </div>
        <div class="baf-group">
          <a class="baf" href="http://chaosradio.ccc.de/chaosradio.html">Chaosradio</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('cr', $i); ?>
          </ul>
        </div>
        <div class="baf-group">
          <a class="baf" href="http://not-safe-for-work.de">Not Safe For Work</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('nsfw', $i); ?>
          </ul>
        </div><br>
        <div class="baf-group">
          <a class="baf" href="http://einschlafen-podcast.de">Einschlafen&nbsp;Podcast</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('ep', $i); ?>
          </ul>
        </div>
        <div class="baf-group">
          <a class="baf" href="http://mobilemacs.de/">mobileMacs</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('mm', $i); ?>
          </ul>
        </div>
        <div class="baf-group">
          <a class="baf" href="http://monoxyd.de/category/dieweisheit">Der&nbsp;Weisheit</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('dw', $i); ?>
          </ul>
        </div>
        <div class="baf-group">
          <a class="baf" href="http://www.jobscast.de">Jobscast</a>
          <a class="baf dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <?php $i = getEpisodes('jc', $i); ?>
          </ul>
        </div>
        <!--<p>Zu diesen Podcasts gibt es bei uns insgesamt <?php echo $i; ?> Shownote Eintr&auml;ge. <br>Die gesamte Liste der Shownotes ist im <a href="https://shownotes.piratenpad.de/ep/padlist/all-pads">Etherpad</a> zu finden.</p>--><br>
      </div>
    </div>
    <hr />
    <div style="margin: 0px;">
      <div style="float: left;">
        <div class="info_icon"><img src="http://cdn.shownot.es/img/flattr_icon.png" alt="Flattr Logo" width="30px" height="30px" />
        </div>
      </div>
      <p style="float: left; width: 700px;">Um unsere Vorhabungen zu finanzieren, sind wir nach wie vor auf eure Spenden angewiesen. Daher w&uuml;rde es uns freuen, wenn ihr uns ab und zu <a href="https://flattr.com/thing/874771/Die-Shownotes">flattern</a> k&ouml;nntet.
      </p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <div style="float: left;">
        <div class="info_icon"><img src="http://cdn.shownot.es/img/twitter_icon.png" alt="Twitter Logo" width="30px" height="30px" />
        </div>
      </div>
      <p style="float: left; width: 700px;">Zus&auml;tzliche Informationen sind &uuml;ber unsere Twitter Accounts zu erhalten: <a href="http://twitter.com/dieshownotes">@DieShownotes</a>, <a href="http://twitter.com/quimoniz">@Quimoniz</a>, <a href="http://twitter.com/gurkitier">@Gurkitier</a>, <a href="http://twitter.com/kaeffchen_heinz">@kaeffchen_heinz</a>, <a href="http://twitter.com/simonwaldherr">@SimonWaldherr</a>.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <div style="float: left;">
        <div class="info_icon"><img src="http://cdn.shownot.es/img/irc_icon.png" alt="IRC Logo" width="30px" height="30px" />
        </div>
      </div>
      <p style="float: left; width: 700px;">Neben Twitter k&ouml;nnt ihr uns auch im IRC auf <a href="irc://irc.freenode.net/shownotes">freenode</a> erreichen. (<a href="http://webchat.freenode.net/?channels=%23shownotes">Webchat</a>)
      </p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <div style="float: left;">
        <div class="info_icon"><img src="http://cdn.shownot.es/img/git_icon.png" alt="GitHub Logo" width="30px" height="30px" />
        </div>
      </div>
      <p style="float: left; width: 700px;">Der Großteil der Entwicklung erfolgt auf <a href="https://github.com/">GitHub</a>. Jeder der mithelfen will, kann gerne Pull-Requests an die Repositorys <a href="https://github.com/SimonWaldherr/shownot.es">SimonWaldherr/shownot.es</a>, <a href="https://github.com/SimonWaldherr/OpenShownotesFormat">SimonWaldherr/OpenShownotesFormat</a>, <a href="https://github.com/SimonWaldherr/OSF-Editor">SimonWaldherr/OSF-Editor</a>, <a href="https://github.com/mluto/ShowPad">mluto/ShowPad</a> sowie <a href="https://github.com/mluto/etherpad-lite">mluto/etherpad-lite</a> schicken.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <hr />
    <p>Wer Podcasts mag, sollte <a href="http://epirat.basedrive.net/">ReLive</a> und die <a href="http://hoersuppe.de/">H&ouml;rsuppe</a> kennen. Desweiteren ist <a href="http://podpott.de/">Podpott</a> immer einen Besuch wert.</p>
  </div>
<div class="footer">&nbsp;<span>&copy; 2012 <a href="/">shownot.es</a>
</div>
</div>
<script type="text/javascript" src="http://cdn.shownot.es/baf/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="http://cdn.shownot.es/tinybox/tinybox.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34667234-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = 'http://statistik.simon.waldherr.eu/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html><?php

$inhalt = ob_get_contents();
ob_end_clean();


if (!empty($file_contents))
{
  $tweetbackup = './../tweets/index.html';
  if (!$handle = fopen($tweetbackup, 'w'))
    {
      echo 'Cannot open file '.$tweetbackup;
    }
  $file_contents = '<!DOCTYPE html>
<html lang="de"> 

<head>
  <meta charset="utf-8" />
  <title>Die Shownotes Tweets</title>
  <meta name="viewport" content="width=980" />  
  <meta name="apple-mobile-web-app-capable" content="yes" />  
  <link rel="shortcut icon" type="image/x-icon" href="./../favicon.ico" />
  <link rel="icon" type="image/x-icon" href="./../favicon.ico" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/style.min.css?v=004" type="text/css" />
  <link rel="author" href="./../humans.txt" />
  <link rel="apple-touch-startup-image" href="http://cdn.shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://cdn.shownot.es/img/iPadPortait.png" />
  <style>
    .itemlist{
      height: auto;
      overflow: auto;
    }
  </style>
  <script type="text/javascript">
  
    var _gaq = _gaq || [];
    _gaq.push(["_setAccount", "UA-34667234-1"]);
    _gaq.push(["_trackPageview"]);
  
    (function() {
      var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
      ga.src = "http://statistik.simon.waldherr.eu/ga.js";
      var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
    })();
  
  </script>
</head>

<body>
<div class="content">
  <div class="header">
    <div class="title"><a href="http://shownot.es/"><img src="http://cdn.shownot.es/img/logo.png">Die Shownotes</a></div>
  </div>
  <div class="box" id="main">'.$file_contents.'</div>
  <div class="footer">&nbsp;<span>&copy; 2012 <a href="/">shownot.es</a></div>

</div>
</body>

</html>';
  if (fwrite($handle, $file_contents) === FALSE)
    {
      echo 'Cannot write to file '.$tweetbackup;
      exit;
    }
  
  fclose($handle);
}
  
  $generatetime = microtime(1)-$starttime;
  $cache_refresh = 2520;
  $code = '<?php if('.(time()+$cache_refresh).' < time()){'."\n".'echo "<iframe src=\"http://shownot.es/update/\"></iframe>";} ?>';
  
  $filename = './../index.php';
  $inhalt = explode('<body onload="loadShownotes();">', $inhalt);
  $inhalt = $inhalt[0].'<body onload="loadShownotes();"><!-- '."\n".'zuletzt aktualisiert um: '.time().' ('.date("H:i:s d.m.Y").")\n".'Generierungsdauer: '.$generatetime.' sec'."\n".'-->'.$code.$inhalt[1];
?>