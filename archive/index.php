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
  <link rel="apple-touch-startup-image" href="http://shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://shownot.es/img/iPadPortait.png" />
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
    </p><hr><br><table border="0">
      <tr><th>Podcast</th><th>Episode</th><th>Datum</th><th>OSF</th></tr>
<?php

$db = new SQLite3('archive.sqlite3');
$results = $db->query('SELECT * FROM "main"."valid" ORDER BY "episodetime" DESC');
while ($row = $results->fetchArray()) {
    echo '<tr><td>'.$row['podcast'].'</td><td>'.$row['episode'].'</td><td>'.date("d.m.Y", $row['episodetime']).'</td><td><a href="./cache/osf/'.$row['podcast'].'_'.$row['episode'].'.osf.txt">'.str_replace(array('bak-','.json'),array('',''),$row['filename']).'</a></td></tr>';
}

?>

</table>
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