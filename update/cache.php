<?php

$starttime = microtime(1);
ob_start();

function shuffleByFiletime($array) {
  $i = 0;
  $shownotetimes = array();
  foreach($array as $podcast) {
    $shownotetimes[$i] = filemtime('./../podcasts/' . $podcast[1]);
    $i++;
  }
  $sortedarray = array();
  arsort($shownotetimes);
  foreach($shownotetimes as $index => $times) {
    $sortedarray[] = $array[$index];
  }
  asort($logarray);
  return $sortedarray;
}

function printPodcastBox($podcast, $count) {
  $found_podcasts = false;
  $file_arr = array();
  $i = 0;
  if ($handle = @scandir('./../podcasts/' . $podcast[1], 1)) {
    foreach($handle as $file) {
      if ($file != "." && $file != "..") {
        $Episode = explode('.', $file);
        if($Episode[2] != '') {
	  $file_arr[$i++] = $Episode;
        }
      }
    }

    if (0 < $i) {
      $found_podcasts = true;
      $Episode = $file_arr[0];
      $linkname = str_replace('_', '.', $Episode[1]);
      $link = 'http://shownot.es/'.$podcast[1].'/'.ltrim($Episode[0], '0 \t\n\r');
      $linkname_title=$linkname;
      $slug_match;
      if( FALSE !== ($slug_match = stripos($linkname, $podcast[0])) ) {
        $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[0]));
      } else if ( FALSE !== ($slug_match = stripos($linkname, $podcast[1])) ) {
        $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[1]));
      }
      $linkname_title_reg_ret = @preg_replace("/-([0-9]+)/"," \\1", $linkname_title);
      if ( NULL !== $linkname_title_reg_ret) {
        $linkname_title = $linkname_title_reg_ret;
      }
      if ( FALSE === stripos($linkname_title, $podcast[1]) &&  FALSE === stripos($linkname_title, $podcast[0])) {
        $linkname_title = $podcast[0] . ': ' . $linkname_title;
      }
      if ( isset($podcast[5])) {
        $linkname_title.="\n";
        $linkname_title.=$podcast[5];
      }
      echo "      <div class=\"thispodcast\">\n";
      echo "        <div class=\"podcastimg\">\n";
      echo '          <a href="' . $link . '" title="' . $linkname_title . '" >';
      echo "\n";
      echo "            <img src=\"http://shownot.es/img/logos/" . $podcast[3] . "\" alt=\"" . $podcast[4] . "\" />\n";
      echo "          </a>\n";
      echo "        </div>\n";
      echo "        <div class=\"baf-group\">\n";
      echo "\n";
      echo "          <a class=\"baf bluehover dropdown-toggle\" data-toggle=\"dropdown\" style=\"width: 148px; height: 28px; padding: 0px;\" >\n";
      echo "            <div style=\"float: left; opacity: 0.4; margin: 6px 0px 7px 6px;\"><img src=\"/img/blurred-text-small.png\" width=\"15\" height=\"15\" onclick=\"this.parentNode.parentNode.click();\"/></div>";
      echo "            <div style=\"float: left; text-align: left; margin: 8px 0px 0px 6px; overflow: hidden; width: 118px; height: 20px; word-spacing: -1px;\" onclick=\"this.parentNode.click();\">" . $podcast[0] . "</div>";
      echo "          </a>";
      echo "          <div class=\"dropdown-menu\" style=\"max-width: none; width: 400px; padding: 0px; height: auto; overflow: hidden; border: 1px solid rgb(210, 210, 210); border-bottom-left-radius: 4px;\">";
      echo "            <div class=\"menu_bar\">";
      echo "              <div style=\"float: left; opacity: 0.4; margin: 7px 0px 7px 9px;\"><img src=\"/img/blurred-text-small.png\" width=\"15\" height=\"15\"/></div>";
      echo "              <div style=\"float: left; margin: 7px 0px 8px 11px;\">" . htmlentities($podcast[0], ENT_QUOTES, "UTF-8") . " Shownotes</div>";
      echo "              <div class=\"close_button\" style=\"float: right;\" onclick=\"baf_dropdownclose()\" title=\"Schliessen\"> &nbsp; </div/>";
      echo "            </div>";
      echo "            <img src=\"http://shownot.es/img/logos/" . $podcast[3] . "\" width=\"210\" height=\"210\" style=\"float: left;\"";
      if (isset($podcast[5]) && 0 < strlen('' . $podcast[5])) {
          echo "title=\"" . $podcast[5] . "\"";
      }
      echo ">\n         <ul style=\"float: right; width: 189px; text-align: left; height: 256px; overflow: auto; background-image: linear-gradient(to right, rgb(234, 234, 234) 0%, rgb(246, 246, 246) 6%, rgb(250, 250, 250) 50%, rgb(246, 246, 246) 94%, rgb(234, 234, 234) 100%); padding-left: 0px; border-left: 1px solid rgb(220, 220, 220);\">\n";

      echo '              <li><a href="'.$link.'" title="' . $linkname_title . '">'.htmlentities($linkname, ENT_QUOTES, "UTF-8").'</a></li>';
      echo "\n";
      ++$count;

      for($j = 1; $j < $i; $j++) {
        $Episode = $file_arr[$j];
        $linkname = str_replace('_', '.', $Episode[1]);
        $link = 'http://shownot.es/'.$podcast[1].'/'.ltrim($Episode[0], '0 \t\n\r');
        $linkname_title=$linkname;
        $slug_match;
        if( FALSE !== ($slug_match = stripos($linkname, $podcast[0])) ) {
          $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[0]));
        } else if ( FALSE !== ($slug_match = stripos($linkname, $podcast[1])) ) {
          $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[1]));
        }
        $linkname_title_reg_ret = @preg_replace("/-([0-9]+)/"," \\1", $linkname_title);
        if ( NULL !== $linkname_title_reg_ret) {
          $linkname_title = $linkname_title_reg_ret;
        }
        if ( FALSE === stripos($linkname_title, $podcast[1]) &&  FALSE === stripos($linkname_title, $podcast[0])) {
          $linkname_title = $podcast[0] . ': ' . $linkname_title;
        }
        echo '              <li><a href="'.$link.'" title="' . $linkname_title . '">'.htmlentities($linkname, ENT_QUOTES, "UTF-8").'</a></li>';
        echo "\n";
        ++$count;
      }
      echo "            </ul>";
/* Note: Button is pretty big with such a height, maybe use baf height instead? */
      echo "            <div style=\"height: 40px;\">";
      echo "              <div class=\"baf bluehover\" style=\"width: 184px; height: 28px; border-radius: 0px;\" title=\"" . $podcast[2] . "\">\n                <a href=\"" . $podcast[2] . "\">Webseite</a>\n              </div>\n            </div>\n          </div>";
      echo "\n        </div>\n      </div>\n";
    }
  }

  if ( false === $found_podcasts) {
    echo "            <li>Verzeichnis leer</li>\n";
  }
  return $count;
}

?><!DOCTYPE html>
<html lang="de"> 
<head>
  <meta charset="utf-8" />
  <title>Shownot.es</title>
  <meta name="viewport" content="width=980" />  
  <meta name="apple-mobile-web-app-capable" content="yes" />  
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
  <link rel="icon" type="image/x-icon" href="/favicon.ico" />
  <link rel="stylesheet" href="/baf/css/baf.min.css?v=010" type="text/css"  media="screen" />
  <link rel="stylesheet" href="/css/style.min.css?v=010" type="text/css" />
  <link rel="stylesheet" href="/css/anycast.min.css?v=010" type="text/css"  media="screen" />
  <link rel="stylesheet" href="/css/startseite.min.css?v=010" type="text/css"  media="screen" />
  <link rel="apple-touch-startup-image" href="http://shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://shownot.es/img/iPadPortait.png" />
</head>
<body onload="baf_listenerInit();">
<div class="content">
  <div class="box" id="main">
    <div class="header">
      <div class="title"><a href="/"><img src="http://shownot.es/img/logo_app.png" alt="Shownot.es Logo">Die Shownotes</a></div>
    </div>
    <p style="margin-top: 1em; text-align: center;">
      Wir sind eine Community, die Shownotes f&uuml;r verschiedene Podcast- und Radioformate live mitnotiert.<br><br>Das Showpad, unseren Editor, findet ihr auf <a href="http://pad.shownot.es/"><strong>pad.shownot.es</strong></a>.
    </p><hr><br>
    <div id="podcasts">
      <p style="margin-top: 1em; text-align: center;">
         F&uuml;r die folgenden Podcasts wurden bisher schon ausführliche Shownotes von vielen freiwilligen Helfern verfasst:
      </p>
      <br/><br/>

<style type="text/css">
div.dropdown-menu {
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}
div.menu_bar {
  background-image: linear-gradient(to bottom , rgb(245, 245, 245), rgb(241, 241, 241));
  float: left;
  margin-left: 0px;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  width: 400px;
  height: 30px;
  text-align: left;
  padding: 0px;
  cursor: auto;
  color: rgb(68, 68, 68);
  -moz-user-select: none;
}
div.close_button {
  background-image:url(http://shownot.es/img/close.png);
  background-position: 0px 0px;
  width: 30px;
  height: 30px;
  background-repeat: no-repeat;
  margin: 0px 0px 0px 0px;
  cursor: pointer;
  opacity: 0.8;
  transition: opacity 100ms;
}
div.close_button:hover {
  background-position: 0px -30px;
  opacity: 1;
  transition: opacity 200ms;
}
div.close_button:active {
  margin: 2px 0px 0px 0px;
}
</style>
<?php
/* An array to contain all the podcasts we link to on the front page.
 * a podcast is entered as an array, that array has up to 6 parameters, of which the last is optional:
 *   0: Name of the podcast
 *   1: slug (folder where the podcast is located at)
 *   2: the general web address under which the podcast resides
 *   3: name of the logo file
 *   4: alternate text of the logo file
 *   5: Optional. Additional title text for the logo file
 */
$podcast_arr = array(
  array('1337kultur','lk','http://1337kultur.de/','lk_logo.png','1337kultur Logo'),
  array('ABSradio','abs','http://absradio.de/','abs_logo.png','ABSradio Logo'),
  array('Blue Moon','bm','http://www.fritz.de/media/podcasts/sendungen/blue_moon.html','bmll_logo.png','BlueMoon / Lateline Logo', 'Blue Moon Foto von Ainhoa Pcb l, CC: BY'),
  array('Culinaricast','culinaricast','http://www.culinaricast.de/','culinaricast_logo.png','Culinaricast Logo'),
  array('Chaosradio','cr','http://chaosradio.ccc.de/chaosradio.html','cr_logo.png','Chaosradio Logo'),
  array('CRE','cre','http://cre.fm/','cre_logo.png','CRE Logo'),
  array('Einschlafen','ep','http://einschlafen-podcast.de/','ep_logo.png','EinschlafenPodcast Logo'),
  array('Freak Show','mm','http://freakshow.fm/','fs_logo.png','Freak Show Logo'),
  array('Jobscast','jc','http://www.jobscast.de/','jc_logo.png','Jobscast Logo'),
  array('LeCast','lecast','http://www.bullosamedia.de/','lecast_logo.png','LeCast Logo'),
  array('Netzgespräche','ng','http://www.xn--netzgesprche-ocb.de/','ng_logo.png','Netzgespräche Logo'),
  array('Not Safe for Work','nsfw','http://not-safe-for-work.de/','nsfw_logo.png','NSFW Logo'),
  array('Psychotalk','psyt','http://www.psycho-talk.de/','psyt_logo.png','Psychotalk Logo'),
  array('Pubkameraden','pp','http://www.pubkameraden.de/','pp_logo.png','Pubkameraden Podcast Logo'),
  array('Quasselstrippen','qs','http://die-quasselstrippen.de/','qs_logo.png','Quasselstrippen Logo'),
  array('Radio OSM','osm','http://blog.openstreetmap.de/','osm_logo.png','Radio OSM Logo'),
  array('Robotiklabor','rl','http://www.robotiklabor.de/','rl_logo.png','Robotiklabor Logo'),
  array('Sondersendung','dss','http://die-sondersendung.de/','dss_logo.png','Sondersendung Logo'),
  array('SozioPod','sozio','http://soziopod.de/','sozio_logo.png','SozioPod Logo'),
  array('Wikigeeks','wg','http://wikigeeks.de/','wg_logo.png','Wikigeeks Logo'),
  array('Wir. Müssen Reden','wmr','http://wir.muessenreden.de/','wmr_logo.png','Wir. Müssen Reden Logo'),
  array('WRINT','wrint','http://www.wrint.de/','wr_logo.png','WRINT Logo')
);

$podcast_arr = shuffleByFiletime($podcast_arr);

$ele_count = count($podcast_arr);
$i = 0;
$j = 0;
for($i = 0; $i < $ele_count; $i++) {
  $j = printPodcastBox($podcast_arr[$i], $j);
}

?>
      <div class="thispodcast">
        <div class="podcastimg">
        <a href="http://shownot.es/anmelden/"><img src="http://shownot.es/img/logos/shownotes_logo.png" alt="Shownotes Logo" /></a>
          
        </div>
        <div class="baf-group">
          <a class="baf bluehover" id="newPodcast" href="http://shownot.es/anmelden/">Podcast anmelden</a>
        </div>
      </div>
      
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <hr />
    <p style="text-align: center;">Weitere Informationen f&uuml;r Podcaster gibt es hier: <a href="/faq/">shownot.es/faq/</a></p>
    <hr/>
    <div style="margin: 0px;">
      <p class="clause flattrimg">Um unsere Vorhabungen zu finanzieren, sind wir nach wie vor auf eure Spenden angewiesen. Daher w&uuml;rde es uns freuen, wenn ihr uns ab und zu <a href="https://flattr.com/profile/shownotes">flattern</a> k&ouml;nntet.
      </p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause twitterimg">Ihr wollt mitmachen oder habt Fragen zur Plattform? Dann wendet euch doch einfach auf Twitter an das Team hinter Shownot.es: <br><a href="http://twitter.com/dieshownotes">@DieShownotes</a>, <a href="https://twitter.com/evitabley">@EvitaBley</a>, <a href="https://twitter.com/luutoo">@luutoo</a>, <a href="https://twitter.com/kaikubasta">@KaiKubasta</a>, <a href="https://twitter.com/kaeffchen_heinz">@kaeffchen_heinz</a>, <a href="https://twitter.com/mrmoe">@mrmoe</a>, <a href="https://twitter.com/dr4k3_LE">@Dr4k3_LE</a> und <a href="https://twitter.com/simonwaldherr">@SimonWaldherr</a>.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause adnimg">Neben Twitter könnt ihr das Team auch auf <a href="http://app.net/">App.net</a> erreichen: <a href="https://alpha.app.net/shownotes" rel="me">@Shownotes</a>, <a href="https://alpha.app.net/evita">@Evita</a>, <a href="https://alpha.app.net/luto">@luto</a>, <a href="https://alpha.app.net/moe">@moe</a>, <a href="https://alpha.app.net/dr4k3">@dr4k3</a>, <a href="https://alpha.app.net/vale">@vale</a> und <a href="https://alpha.app.net/simonwaldherr">@SimonWaldherr</a>.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause ircimg">Ausserdem gibt es noch einen IRC Kanal auf <a href="irc://irc.freenode.net/shownotes">freenode.net</a> (<a href="http://webchat.freenode.net/?channels=%23shownotes">Webchat</a>) und das <a href="http://shownot.es/contact/">Kontaktformular</a> . 
      </p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause gitimg">Der Großteil der Entwicklung erfolgt auf GitHub. Jeder der mithelfen will, kann gerne Pull-Requests an <a href="https://github.com/shownotes">unsere Repositorys</a> schicken.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <hr/>
    <div class="widget-inner" style="margin: auto; width: 620px; text-align: center;"><h3 class="widget-title">befreundete Projekte</h3>

<div class="column grid_4"><a href="https://auphonic.com/" title="auphonic" target="_blank"><img src="http://cdn.shownot.es/snprojekte/auphonic_300.png" alt="auphonic" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://bitlove.org/" title="Bitlove" target="_blank"><img src="http://cdn.shownot.es/snprojekte/Bitlove_300.png" alt="Bitlove" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://firtz.org/" title="firtz" target="_blank"><img src="http://cdn.shownot.es/snprojekte/firtz_300.png" alt="Podbe" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://hoersuppe.de/" title="Die Hoersuppe" target="_blank"><img src="http://cdn.shownot.es/snprojekte/hoersuppe_300.png" alt="Die Hoersuppe" width="80" height="80"></a></div>
<div class="column grid_4 last"><a href="http://podbe.wikibyte.org/" title="Podbe" target="_blank"><img src="http://cdn.shownot.es/snprojekte/podbe_300.png" alt="Podbe" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://podcascription.de/" title="Podcascription" target="_blank"><img src="http://cdn.shownot.es/snprojekte/podcascription_300.png" alt="Podcascription" width="80" height="80"></a></div>
<div class="column grid_4 last"><a href="http://podlove.org/" title="Podlove" target="_blank"><img src="http://cdn.shownot.es/snprojekte/podlove_300.png" alt="podlove" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://podpott.de/" title="Podpott" target="_blank"><img src="http://cdn.shownot.es/snprojekte/podpott_300.png" alt="Podpott" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://www.podunion.com/" title="PodUnion" target="_blank"><img src="http://cdn.shownot.es/snprojekte/Logo-Quadrat-300.png" alt="Homepage: PodUnion" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://poodle.fm/" title="Poodle" target="_blank"><img src="http://cdn.shownot.es/snprojekte/poodle_300.png" alt="Poodle" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://reliveradio.de/" title="ReliveRadio" target="_blank"><img src="http://cdn.shownot.es/snprojekte/reliveradio.png" alt="ReliveRadio" width="80" height="80"></a></div>
<div class="column grid_4"><a href="http://streams.xenim.de/" title="Xenim" target="_blank"><img src="http://cdn.shownot.es/snprojekte/xsn_300.png" alt="Xenim" width="80" height="80"></a></div>
<div class="column grid_4"></div>
<div class="column grid_4 last"></div>
<div class="clear"></div></div>
    <br/><div class="flattrbtn"><a class="FlattrButton" href="http://shownot.es/" title="Die Shownot.es" lang="de_DE">
      [description]
    </a></div><iframe style="visibility: visible; height: 23px; width: 200px;" src="http://platform.twitter.com/widgets/tweet_button.html?url=http%3A%2F%2Fshownot.es%2F&amp;text=Die%20Shownot.es" style="width:110px; height:20px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe><span style="text-align: right;display: inherit;margin-top: -25px;">Alle Sendungsnotizen unterliegen der <a href="http://creativecommons.org/publicdomain/zero/1.0/">CC0-Lizenz</a> (Public Domain).</span>
  </div>
</div>
<br/><br/>
<script src="http://selfcss.org/baf/js/baf.min.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34667234-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = 'http://statistik.simon.waldherr.eu/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

/* <![CDATA[ */
    (function() {
        var s = document.createElement('script');
        var t = document.getElementsByTagName('script')[0];

        s.type = 'text/javascript';
        s.async = true;
        s.src = '//api.flattr.com/js/0.6/load.js?'+
                'mode=auto&uid=shownotes&language=de_DE&category=text&button=compact&popout=0';
        s.button = 'compact';
        s.popout = false;

        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */

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
  <link rel="stylesheet" href="http://cdn.shownot.es/css/style.min.css?v=006" type="text/css" />
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
  <div class="footer"><span style="text-align: right;">Alle Sendungsnotizen unterliegen der <a href="http://creativecommons.org/publicdomain/zero/1.0/">CC0-Lizenz</a> (Public Domain).</span></div>

</div>
</body>

</html>';
  if (fwrite($handle, $file_contents) === FALSE) {
    echo 'Cannot write to file '.$tweetbackup;
    exit;
  }
  fclose($handle);
}

  $generatetime = microtime(1) - $starttime;
  $cache_refresh = 86400;
  $code = '<?php if('.(time() + $cache_refresh).' < time()){'."\n".'echo "<iframe src=\"http://shownot.es/update/\"></iframe>";} ?>';
  
  $filename = './../index.php';
  $inhalt = explode('<body onload="loadShownotes();">', $inhalt);
  $inhalt = $inhalt[0].'<body onload="loadShownotes();"><!-- '."\n".'zuletzt aktualisiert um: '.time().' ('.date("H:i:s d.m.Y").")\n".'Generierungsdauer: '.$generatetime.' sec'."\n".'-->'.$code.$inhalt[1];
?>
