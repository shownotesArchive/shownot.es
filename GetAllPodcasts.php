<?php

$podcasts = array(
                  'mm' => array(94 => 'mm094gekuerzt', 
                                93 => 'mm93', 
                                92 => 'MM92', 
                                91 => 'MM91', 
                                90 => 'MM90', 
                                89 => 'mobilemacs-20089', 
                                88 => 'MM088', 
                                87 => 'MM087-2', 
                                86 => 'MM086', 
                                85 => 'MM085', 
                                84 => 'MM084', 
                                82 => 'MM082', 
                                81 => 'MM081'),
                                
                  'nsfw' => array(55 => 'nsfw055', 
                                  54 => 'NSFW054',
                                  53 => 'NSFW053',
                                  52 => 'NSFW052',
                                  51 => 'NSFW051',
                                  50 => 'NSFW050',
                                  49 => 'NSFW049',
                                  48 => 'NSFW048',
                                  47 => 'nsfw47',
                                  46 => '15',
                                  45 => 'nsfw45',
                                  44 => '13',
                                  41 => '3'),
                                  
                  'ep' => array(178 => 'ep178',
                               177 => 'ep177',
                               176 => 'ep176',
                               169 => 'ep169',
                               168 => 'ep168',
                               167 => 'ep')
                  );

foreach($podcasts as $podcastname => $podcast)
  {
    $i = 0;
    foreach($podcast as $episodenr => $padname)
      {
        //echo $i.' - '.$podcastname.' - '.$episodenr.' - '.$padname."\n";
        //$i++;
        
        $url = 'https://shownotes.piratenpad.de/ep/pad/export/'.$padname.'/latest?format=html';
        $datei = fopen($url, "rb");
        $inhalt = stream_get_contents($datei);
        fclose($datei);
        if (!empty($inhalt))
          {
            $filename = './podcasts/'.$podcastname.'/'.$episodenr.'.'.strtoupper($podcastname).'-'.$episodenr.'.html';
            $inhalt = explode('<body>', $inhalt);
            $inhalt = explode('</body>', $inhalt[1]);
            $inhalt = $inhalt[0];
            if (!$handle = fopen($filename, 'w'))
              {
                echo 'Cannot open file '.$filename;
                exit;
              }
          
            if (fwrite($handle, $inhalt) === FALSE)
              {
                echo 'Cannot write to file '.$filename;
                exit;
              }
          
            echo 'Success, wrote '.strtoupper($podcastname).'-'.$episodenr.' to file '.$filename;
          
            fclose($handle);
          }
        else
          {
            echo 'Cannot open '.$url;
          }
      }
  }

?>
