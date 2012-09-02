<?php

function echojsonfor($podcast_folder)
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
            echo '}';
              }
          }
        echo "}";
      }
  }

$podcast_name = $_GET['pc'];
$export_mode  = $_GET['mode'];

if(($export_mode == 'json')||($export_mode == ''))
  {
    if((isset($podcast_name) && 1 === preg_match('/^[a-zA-Z0-9_-]{1,16}$/', $podcast_name))&&($podcast_name != 'all'))
      {
        $podcast_folder = './podcasts/' . $podcast_name;
        echojsonfor($podcast_folder);
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
                echojsonfor($podcastdir);
    
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
else
  {
    //XML coming soon ...
  }

?>