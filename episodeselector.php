<?php

function insertselector($podcast=false)
  {
    $count = 0;
    $count2 = 0;
    $last = false;
    $prev = '';
    $next = '';
    if($podcast === false)
      {
        $info = explode('/', $_GET['podcast']);
      }
    
    $printit = '';
    if ($handle = @scandir('./'.$info[1].'/', 1))
      {
        foreach($handle as $file)
          {
            if ($file != "." && $file != "..")
              {
                $Episode = explode('.', $file);
                if($Episode[2] != '')
                  {
                    if(($count == 0)&&($Episode[0] == $info[2]))
                      {
                        $last = true;
                        
                      }
                    
                    if($Episode[0] == $info[2])
                      {
                        $count2 = $count;
                      }
                    
                    $files[$count] = ltrim($Episode[0], '0 \t\n\r');
                    $link = './'.ltrim($Episode[0], '0 \t\n\r');
                    $printit .= '<li><a ';
                    if($info[2] == ltrim($Episode[0], '0 \t\n\r'))
                      {
                        $printit .= 'id="selected" ';
                      }
                    $printit .= 'href="'.$link.'">Episode '.ltrim($Episode[0], '0 \t\n\r').'</a></li>';
                    ++$count;
                  }
              }
          }
      }
  
    echo '<div class="baf-group-x1"><a class="baf bluehover grey prev" href="http://shownot.es/'.$info[1].'/'.$files[$count2+1].'"><span class="baf-icomoon bigger" aria-hidden="true" data-icon="&#xe0a2;"></span></a><div class="baf-group"><a class="baf bluehover dropdown-toggle w80">Episode '.$files[$count2].'<span class="caret"></span></a><ul class="dropdown-menu">';
    
    echo $printit;
    
    echo '</ul></div><a class="baf bluehover grey next"';
    if($last)
      {
        echo ' disabled="true"';
      }
    else
      {
        echo ' href="http://shownot.es/'.$info[1].'/'.$files[$count2-1].'"';
      }
    echo ' ><span class="baf-icomoon bigger" aria-hidden="true" data-icon="&#xe0a0;"></span></a></div>';
  }

?>
