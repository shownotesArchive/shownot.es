<?php
function getEpisodes($count, $podcast = 'all')
  {
    if ($handle = @scandir('./'))
      {
        foreach($handle as $folder)
          {
            if ($folder != "." && $folder != ".." && is_dir($folder) && (($podcast == 'all')||($podcast == $folder)))
              {
                $handle2 = @scandir('./'.$folder, 1);
                echo '<h2 id="'.$folder.'">'.$folder.'</h2><ol>';
                foreach($handle2 as $file)
                  {
                    if ($file != "." && $file != ".." && $file != 'index.php')
                      {
                        $Episode = explode('.', $file);
                        echo '<li><a href="./sn/'.$folder.'/'.ltrim($file, '0 \t\n\r').'">'.(2 < count($Episode) ? $Episode[1] : $Episode[0]).'</a></li>';
                        ++$count;
                      }
                  }
                echo '</ol>'."\n";
              }
          }
      }
    return $count;
  }

function ShownoteTitle()
  {
    $podcast = $_GET['podcast'];
    $podcast = str_replace(array("ae", "oe", "ue", "&auml;", "&ouml;", "&uuml;"), array("ä", "ö", "ü", "ä", "ö", "ü"), $podcast);
    
    if($podcast != '')
      {
        if(isset($_GET['search']))
          {
            $podcastarray = explode("/",$podcast);
            $podcastlist = scandir('./'.$podcastarray[1].'/');
            foreach($podcastlist as $thispodcast)
              {
                $thispodcastarray = @explode(".",$thispodcast);
                if($podcastarray[2] == $thispodcastarray[0])
                  {
                    $podcast = $thispodcast;
                  }
              }
          }
        $title = explode('.', $podcast);
        return (3 < count($title) ? $title[2] : $title[1]).' - Shownot.es';
      }
    else
      {
        return 'Shownotes &Uuml;bersicht';
      }
  }

$podcast = $_GET['podcast'];

if(($podcast != '')&&($_GET['clear'] == 'true'))
  {
    if(isset($_GET['search']))
      {
        $podcastarray = explode("/",$podcast);
        //var_dump($podcastarray);
        $podcastlist = scandir('./'.$podcastarray[1].'/');
        foreach($podcastlist as $thispodcast)
          {
            $thispodcastarray = @explode(".",$thispodcast);
            if($podcastarray[2] == $thispodcastarray[0])
              {
                //echo "\n".'./'.$podcastarray[1].'/'.$thispodcast."\n";
                include('./'.$podcastarray[1].'/'.$thispodcast);
                die();
              }
          }
      }
    else
      {
        //echo '<h2><a href="./../../../">zur&uuml;ck zur &Uuml;bersicht</a></h2>';
        include($podcast);
        die();
      }
  }

?><!DOCTYPE html>
<html lang="de"> 

<head>
  <meta charset="utf-8" />
  <title><?php echo ShownoteTitle(); ?></title>
  <meta name="viewport" content="width=715" />  
  <link rel="shortcut icon" type="image/x-icon" href="http://shownot.es/favicon.ico" />
  <link rel="icon" type="image/x-icon" href="http://shownot.es/favicon.ico" />
  <link href="http://selfcss.org/baf/css/baf.css?v=002" media="screen" rel="stylesheet" type="text/css"/>
  <link href="http://selfcss.org/baf/css/icomoon.css?v=002" media="screen" rel="stylesheet" type="text/css"/>
  <script src="http://selfcss.org/baf/js/baf.min.js"></script>
  <link rel="stylesheet" href="../css/style.css?v=008" type="text/css" />
  <link rel="stylesheet" href="../css/anycast.min.css?v=008" type="text/css" media="screen">
  <link rel="stylesheet" href="../css/shownotes.min.css?v=002" type="text/css" media="screen">
  <link rel="stylesheet" href="http://cdn.shownot.es/include-shownotes/shownotes.css" type="text/css" media="screen">
  <link rel="apple-touch-startup-image" href="http://cdn.shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://cdn.shownot.es/img/iPadPortait.png" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/fa/css/font-awesome.min.css"/>
  
  <style id="editablestyle"></style>
  <style>
  	iframe {
  		visibility: visible; height: 23px; width: 130px;
  	}
  </style>
</head>

<body onload="baf_listenerInit();">
<div id="background"></div>
<div class="content">
  <div class="header">
    <div class="title"><a href="http://shownot.es/"><img src="http://cdn.shownot.es/img/logo.png">Die Shownotes</a></div>
  </div>
  <div class="box" id="main">
    
    <?php 
    
    $podcast = $_GET['podcast'];
    $podcastarray = explode("/",$podcast);
    
    if(($podcast != '')&&($podcastarray[1] != ''))
      {
        if(isset($_GET['search']))
          {
            
            //var_dump($podcastarray);
            $podcastlist = scandir('./'.$podcastarray[1].'/');
            foreach($podcastlist as $thispodcast)
              {
                $thispodcastarray = @explode(".",$thispodcast);
                if($podcastarray[2] == $thispodcastarray[0])
                  {
                    //echo "\n".'./'.$podcastarray[1].'/'.$thispodcast."\n";
                    if(is_file('./'.$podcastarray[1].'/'.$thispodcast))
                      {
                        include('./'.$podcastarray[1].'/'.$thispodcast);
                      }
                    else
                      {
                        /*
                        echo '<h1>Dies ist eine Übersicht der Shownotes</h1><br>';
                        getEpisodes(1); 
                        */
                        $podc = true;
                      }
                  }
              }
            if($podc == true)
              {
                getEpisodes(1, $podcastarray[1]);
              }
          }
        else
          {
            if(is_file($podcast))
              {
                echo '<h2><a href="./../../../">zur&uuml;ck zur &Uuml;bersicht</a></h2>';
                include($podcast);
              }
            else
              {
                echo '<h1>Dies ist eine Übersicht der Shownotes</h1><br>';
                getEpisodes(1); 
              }
          }
      }
    else
      {
        echo '<h1>Dies ist eine Übersicht der Shownotes</h1><br>';
        getEpisodes(1); 
      }
    
    

    echo '<br/><a class="FlattrButton" href="'.$__SERVER["SCRIPT_URI"].'" title="'.ShownoteTitle().'" lang="de_DE">
      [description]
    </a> <iframe style="visibility: visible; height: 23px; width: 200px;" src="http://platform.twitter.com/widgets/tweet_button.html?url='.rawurlencode($_SERVER["SCRIPT_URI"]).'&amp;text='.rawurlencode(strip_tags(ShownoteTitle())).'" style="width:110px; height:20px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>';
    ?>
  </div>

  <div class="footer">&nbsp;<span>&copy; 2011-2013 <a href="/">shownot.es</a></div>

</div>
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