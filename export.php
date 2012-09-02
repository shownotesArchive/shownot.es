<?php

function echojsonfor($podcast_folder, $hash_mode)
  {
    if(is_dir($podcast_folder))
      {
        $files_in_folder;
        if(isset($_GET['desc']))
          {
            $files_in_folder = array_reverse(scandir($podcast_folder));
          }
        else
          {
            $files_in_folder = scandir($podcast_folder);
          }
        $first_file = TRUE;
        echo "{ ";

        foreach($files_in_folder as $file_name)
          {
            if("." == $file_name || ".." == $file_name)
              {

              }
            else
              {
                if($first_file)
                  {
                    $first_file = FALSE;
                  }
                else
                  {
                    echo ", ";
                  }
            $title = explode('.', $file_name);
            echo '"'.$title[0].'": {';
            echo '"filename": '.'"http://shownot.es/'.$podcast_folder.'/'.$file_name.'"';
            echo ', "filesize": '.filesize($podcast_folder.'/'.$file_name);
            echo ', "hash": "'.hash($hash_mode,$podcast_folder.'/'.$file_name).'"';

            $pattern = '([1-9][0-9]*)';
            preg_match($pattern, $title[0], $episodenr);
            $episodenr = ($episodenr[0]+1-1);
            if($episodenr>0)
              {
                echo ', "episode": '.$episodenr;
              }
            if(isset($_GET['title']))
              {
                $titlepattern = '/(.*)(Thema: )(.*)(<)(.*)/';
                preg_match($titlepattern, file_get_contents($podcast_folder.'/'.$file_name), $episodetitle);
                $episodetitle = strip_tags(addslashes($episodetitle[3]));
                if(strlen($episodetitle)>3)
                  {

                    echo ', "title": "'.$episodetitle.'"';
                  }
              }
            echo '}';
              }
          }
        echo "}";
      }
  }

function echocsvfor($podcast_folder, $hash_mode, $pc)
{
  if(is_dir($podcast_folder))
    {
      $files_in_folder;
      if(isset($_GET['desc']))
        {
          $files_in_folder = array_reverse(scandir($podcast_folder));
        }
      else
        {
          $files_in_folder = scandir($podcast_folder);
        }
      $first_file = TRUE;
      //echo "{ ";

      foreach($files_in_folder as $file_name)
        {
          if("." == $file_name || ".." == $file_name)
            {

            }
          else
            {
              if($first_file)
                {
                  $first_file = FALSE;
                }
              else
                {
                  echo "\n";
                }
          $title = explode('.', $file_name);
          

          $pattern = '([1-9][0-9]*)';
          preg_match($pattern, $title[0], $episodenr);
          $episodenr = ($episodenr[0]+1-1);
          
          echo $pc.$title[0].','.$episodenr.',http://shownot.es/'.$podcast_folder.'/'.$file_name.','.filesize($podcast_folder.'/'.$file_name).','.hash($hash_mode,$podcast_folder.'/'.$file_name);
          
          if(isset($_GET['title']))
            {
              $titlepattern = '/(.*)(Thema: )(.*)(<)(.*)/';
              preg_match($titlepattern, file_get_contents($podcast_folder.'/'.$file_name), $episodetitle);
              $episodetitle = strip_tags(addslashes($episodetitle[3]));
              if(strlen($episodetitle)>3)
                {
                  echo ','.$episodetitle;
                }
              else
                {
                  echo ',';
                }
            }
          //echo '}';
            }
        }
      //echo "}";
    }
}

$podcast_name = $_GET['pc'];
$export_mode  = $_GET['mode'];
if(isset($_GET['hash']))
  {
    $hash_mode = $_GET['hash'];
  }
else
  {
    $hash_mode = 'md5';
  }

if(($export_mode == 'json')||($export_mode == ''))
  {
    if((isset($podcast_name) && 1 === preg_match('/^[a-zA-Z0-9_-]{1,16}$/', $podcast_name))&&($podcast_name != 'all'))
      {
        $podcast_folder = './podcasts/' . $podcast_name;
        echojsonfor($podcast_folder, $hash_mode);
      }
    elseif($podcast_name == 'all')
      {
        if(isset($_GET['desc']))
          {
            $podcasts = array_reverse(@scandir('podcasts/', 1));
          }
        else
          {
            $podcasts = @scandir('podcasts/', 1);
          }

        $i = 0;
        echo "{ ";
        foreach($podcasts as $podcast)
          {
            $podcastdir = 'podcasts/'.$podcast;
            if((is_dir($podcastdir))&&($podcast != '.')&&($podcast != '..'))
              {
                if($i>0)
                  {
                    echo ", ";
                  }
                echo '"'.$podcast.'": ';
                echojsonfor($podcastdir, $hash_mode);

                ++$i;
              }
          }
        echo "}";
      }
    else
      {
        header('HTTP/1.1 400 Bad Request');
        echo "{ \"Please specify a GET parameter consisting of 1 to 16 characters out of a-z A-Z 0-9 _ -\" }";
      }
  }
elseif($export_mode == 'csv')
  {
    if((isset($podcast_name) && 1 === preg_match('/^[a-zA-Z0-9_-]{1,16}$/', $podcast_name))&&($podcast_name != 'all'))
      {
        $podcast_folder = './podcasts/' . $podcast_name;
        echocsvfor($podcast_folder, $hash_mode, '');
      }
    elseif($podcast_name == 'all')
      {
        if(isset($_GET['desc']))
          {
            $podcasts = array_reverse(@scandir('podcasts/', 1));
          }
        else
          {
            $podcasts = @scandir('podcasts/', 1);
          }
        
        $i = 0;
        foreach($podcasts as $podcast)
          {
            $podcastdir = 'podcasts/'.$podcast;
            if((is_dir($podcastdir))&&($podcast != '.')&&($podcast != '..'))
              {
                if($i>0)
                  {
                    echo "\n";
                  }
                
                echocsvfor($podcastdir, $hash_mode, $podcast.',');
        
                ++$i;
              }
          }
      }
  }
else
  {
    //XML coming soon ...
  }

?>