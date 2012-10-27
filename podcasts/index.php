<?php
function getEpisodes($count)
  {
    if ($handle = @scandir('./'))
      {
        foreach($handle as $folder)
          {
            if ($folder != "." && $folder != ".." && $folder != 'index.php' && $folder != '.htaccess')
              {
                $handle2 = @scandir('./'.$folder, 1);
                echo '<h2 id="'.$folder.'">'.$folder.'</h2><ol>';
                foreach($handle2 as $file)
                  {
                    if ($file != "." && $file != ".." && $file != 'index.php')
                      {
                        $Episode = explode('.', $file);
                        echo '<li><a href="./sn/'.$folder.'/'.$file.'">'.(2 < count($Episode) ? $Episode[1] : $Episode[0]).'</a></li>';
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
    $podcast = str_replace(array("ae", "oe", "ue", "&auml;", "&ouml;", "&uuml;", "ss"), array("ä", "ö", "ü", "ä", "ö", "ü", "ß"), $podcast);
    
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
        echo '<h2><a href="./../../../">zur&uuml;ck zur &Uuml;bersicht</a></h2>';
        include($podcast);
        die();
      }
  }

?><!DOCTYPE html>
<html lang="de"> 

<head>
  <meta charset="utf-8" />
  <title><?php echo ShownoteTitle(); ?></title>
  <meta name="viewport" content="width=980" />  
  <link rel="shortcut icon" type="image/x-icon" href="http://shownot.es/favicon.ico" />
  <link rel="icon" type="image/x-icon" href="http://shownot.es/favicon.ico" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/style.css" type="text/css" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/baf.css" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/anycast.min.css?v=004" type="text/css" media="screen">
  <link rel="apple-touch-startup-image" href="http://cdn.shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://cdn.shownot.es/img/iPadPortait.png" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>
  <style>
    #background {
      z-index: -1;
      position: fixed;
      top: 0px;
      left: 0px;
      height: 100%;
      width: 100%;
      background: white;
      background: -moz-linear-gradient(top, white 0%, #E5E5E5 60%, #EAEAEA 85%, white 100%);
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,white), color-stop(60%,#E5E5E5), color-stop(85%,#EAEAEA), color-stop(100%,white));
      background: -webkit-linear-gradient(top, white 0%,#E5E5E5 60%,#EAEAEA 85%,white 100%);
      background: -o-linear-gradient(top, white 0%,#E5E5E5 60%,#EAEAEA 85%,white 100%);
      background: -ms-linear-gradient(top, white 0%,#E5E5E5 60%,#EAEAEA 85%,white 100%);
      background: linear-gradient(to bottom, white 0%,#E5E5E5 60%,#EAEAEA 85%,white 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0 );
    }
    h1 {
      font-size: larger;
      font-weight: bolder;
    }
    
    h2 {
      font-size: large;
      margin: 15px;
    }
    
    ol {
      list-style: none;
      margin-left: 45px;
    }
    
    dl {
      width: 670px;
      float: none;
    }
  </style>
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
</head>

<body>
<div id="background"></div>
<div class="content">
  <div class="header">
    <div class="title"><a href="http://shownot.es/"><img src="http://cdn.shownot.es/img/logo.png">Die Shownotes</a></div>
  </div>
  <div class="box" id="main">
    
    <?php 
    
    $podcast = $_GET['podcast'];
    
    if($podcast != '')
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
                  }
              }
          }
        else
          {
            echo '<h2><a href="./../../../">zur&uuml;ck zur &Uuml;bersicht</a></h2>';
            include($podcast);
          }
      }
    else
      {
        echo '<h1>Dies ist eine Übersicht der Shownotes</h1><br>';
        getEpisodes(1); 
      }
    
    
    ?>
  </div>

  <div class="footer">&nbsp;<span>&copy; 2012 <a href="/">shownot.es</a></div>

</div>
<script type="text/javascript" src="http://cdn.shownot.es/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="http://cdn.shownot.es/js/tinybox.js"></script>
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

</html>