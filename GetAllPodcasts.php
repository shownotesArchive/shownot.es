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
                               167 => 'ep'),
                               
                  'wrint' => array(99 => 'wrint23',          //23
                                   95 => 'wrintheit22',      //22
                                   92 => 'wrintheit21',      //21
                                   83 => 'wrintheit20',      //20
                                   78 => 'Wrintheit-XIX',    //19
                                   70 => 'Wrintheit-XVIII',  //18
                                   68 => 'Wrintheit-XVII',   //17
                                   56 => 'wrint16',          //16
                                   53 => 'wrintheit15',      //15
                                   49 => 'wrintheit14',      //14
                                   46 => 'wrint13',          //13
                                   41 => '12',               //12
                                   38 => '7',                //11
                                   34 => '4',                //10
                                   33 => '2'                 //9
                                   )
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
