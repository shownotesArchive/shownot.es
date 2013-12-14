<!DOCTYPE html>
<html lang="de"> 
<head>
  <meta charset="utf-8" />
  <title>Shownot.es</title>
  <meta name="viewport" content="width=980" />  
  <meta name="apple-mobile-web-app-capable" content="yes" />  
  <link rel="shortcut icon" type="image/x-icon" href="http://shownot.es/favicon.ico" />
  <link rel="icon" type="image/x-icon" href="http://shownot.es/favicon.ico" />
  <link rel="stylesheet" href="http://shownot.es/baf/css/baf.min.css?v=010" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://shownot.es/css/style.min.css?v=010" type="text/css" />
  <link rel="stylesheet" href="http://shownot.es/css/anycast.min.css?v=010" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://shownot.es/css/startseite.min.css?v=010" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://shownotes.github.io/tinyOSF.js/shownotes.css" type="text/css"  media="screen" />
  <link rel="apple-touch-startup-image" href="http://shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://shownot.es/img/iPadPortait.png" />
  <script src="http://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
  <style>
    table {
      width: 100%;
      text-align: left;
    }
    th {
      font-weight: 800;
    }
    tr {
      background-color: #eee;
    }
    tr:nth-child(odd) {
      background-color: #ddd;
    }
    td, th {
      padding: 5px;
    }
    code {
      white-space: pre-line;
    }
    p.osf_items, div.osf_items {
      padding-left: 30px;
    }
    .osf_chapterbox h2, .osf_chapterbox h3, .osf_chapterbox h4, .osf_chapterbox h5 {
      font-weight: 400 !important;
    }
    .osf_chaptertime, .osf_chapter {
      vertical-align: middle !important;
    }
  </style>
</head>
<body>
<div class="content">
  <div class="box" id="main">
    <div class="header">
      <div class="title"><a href="/"><img src="http://shownot.es/img/logo_app.png" alt="Shownot.es Logo">Die Shownotes</a></div>
    </div>
    <p style="margin-top: 1em; text-align: center;">
      Wir sind eine Community, die Shownotes f&uuml;r verschiedene Podcast- und Radioformate live mitnotiert. Unsere Plattform findet ihr auf <a href="http://pad.shownot.es/"><strong>pad.shownot.es</strong></a>.
    </p><hr/><br/>
<?php

error_reporting(E_ALL);

if(($_GET['episode'] != '')&&($_GET['mode'] != '')) {
  include_once ('./OSFphp/osf.php');
  include_once ('./OSFphp/parse.php');
  $mode = $_GET['mode'];
  $caches = scandir('./cache/', 1);
  $cache = file_get_contents('./cache/'.$caches[1].'/'.str_replace(array('..', '/'), array('', ''), $_GET['episode']));

  $fullmode             = 'true';
  $fullint              = 2;
  $tags                 = explode(' ', 'chapter section spoiler topic embed video audio image shopping glossary source app title quote link podcast news');
  $data['tags']         = $tags;
  $data['fullmode']     = $fullmode;
  $data['amazon']       = 'shownot.es-21';
  $data['thomann']      = '93439';
  $data['tradedoubler'] = '16248286';

  $shownotesArray = osf_parser(html_entity_decode($cache), $data);

  if ($mode == 'block') {
    $mode = 'block style';
  }
  if ($mode == 'list') {
    $mode = 'list style';
  }
  if ($mode == 'osf') {
    $mode = 'clean osf';
  }

  if ($mode == 'shownot.es') {
    $export = '<div class="info">  <div class="thispodcast">  <div class="podcastimg">  <img src="" alt="Logo">  </div> <?php  include "./../episodeselector.php"; insertselector();  ?>  </div>  <div class="episodeinfo">  <table>  <tr>  <td>Podcast</td><td><a href="#"></a></td>  </tr>  <tr>  <td>Episode</td><td><a href="#"></a></td>  </tr>  <tr>  <td>Sendung vom</td><td>'.date("j. M Y").'</td>  </tr>  <tr>  <td>Podcaster</td><td>'.osf_get_persons('podcaster', $shownotesArray['header']).'</td>  </tr>  <tr>  <td>Shownoter</td>  <td>'.osf_get_persons('shownoter', $shownotesArray['header']).'</td>  </tr>  </table>  </div> </div><br/><br/>'."\n\n";
    $export .= osf_export_block($shownotesArray['export'], 2, 'block style');
  } elseif (($mode == 'block style') || ($mode == 'button style')) {
    $export = osf_export_block($shownotesArray['export'], $fullint, $mode);
  } elseif ($mode == 'list style') {
    $export = osf_export_list($shownotesArray['export'], $fullint, $mode);
  } elseif ($mode == 'clean osf') {
    $export = '<pre><code>'.htmlentities(osf_export_osf($shownotesArray['export'], $fullint, $mode)).'</code></pre>';
  } elseif ($mode == 'glossary') {
    $export = osf_export_glossary($shownotesArray['export'], $fullint);
  } elseif (($mode == 'shownoter') || ($mode == 'podcaster')) {
    if (isset($shownotesArray['header'])) {
      if ($mode == 'shownoter') {
        $export = osf_get_persons('shownoter', $shownotesArray['header']);
      } elseif ($mode == 'podcaster') {
        $export = osf_get_persons('podcaster', $shownotesArray['header']);
      }
    }
  } elseif ($mode == 'JSON') {
    $export = json_encode($shownotesArray['export']);
  } elseif ($mode == 'Chapter') {
    $export = osf_export_chapterlist($shownotesArray['export']);
  } elseif ($mode == 'PSC') {
    $export = osf_export_psc($shownotesArray['export']);
  }

  echo $export;
} else {
  echo '<table class="sortable" border="0"><tr><th>Podcast</th><th>Episode</th><th>Datum</th><th colspan="3"></th></tr>';
  $db = new SQLite3('archive.sqlite3');
  $results = $db->query('SELECT * FROM "main"."valid" ORDER BY "episodetime" DESC');
  while ($row = $results->fetchArray()) {
    echo '<tr><td>'.$row['podcast'].'</td><td>'.$row['episode'];
    if(strlen(trim($row['subject'])) > 2) {
      echo ' - <i>'.substr($row['subject'], 0, 20);
      if(strlen($row['subject']) > 20) {
        echo ' ...';
      }
      echo '</i>';
    }
    echo '</td><td sorttable_customkey="'.$row['episodetime'].'">'.date("d.m.Y", $row['episodetime']).'</td><td><a href="./?episode='.$row['podcast'].'_'.$row['episode'].'.osf.txt&mode=block">block</a></td><td><a href="./?episode='.$row['podcast'].'_'.$row['episode'].'.osf.txt&mode=list">list</a></td><td><a href="./?episode='.$row['podcast'].'_'.$row['episode'].'.osf.txt&mode=osf">osf</a></td></tr>';
  }
  echo '</table>';
}

?>

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
<div class="column grid_4"><a href="http://reliveradio.de/" title="Poodle" target="_blank"><img src="http://cdn.shownot.es/snprojekte/poodle_300.png" alt="Poodle" width="80" height="80"></a></div>
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
</html>