<?php

$podcasts = array(
                  'mm' => array(094 => array('mm094gekuerzt','MM094'), 
                                093 => array('mm93','MM093'), 
                                092 => array('MM92','MM092'), 
                                091 => array('MM91','MM091'), 
                                090 => array('MM90','MM090'), 
                                089 => array('mobilemacs-20089','MM089'), 
                                088 => array('MM088','MM088'), 
                                087 => array('MM087-2','MM087'), 
                                086 => array('MM086','MM086'), 
                                085 => array('MM085','MM085'), 
                                084 => array('MM084','MM084'), 
                                082 => array('MM082','MM082'), 
                                081 => array('MM081','MM081')),
                                
                  'nsfw' => array(55 => array('nsfw055','NSFW055'), 
                                  54 => array('NSFW054','NSFW054'),
                                  53 => array('NSFW053','NSFW053'),
                                  52 => array('NSFW052','NSFW052'),
                                  51 => array('NSFW051','NSFW051'),
                                  50 => array('NSFW050','NSFW050'),
                                  49 => array('NSFW049','NSFW049'),
                                  48 => array('NSFW048','NSFW049'),
                                  47 => array('nsfw47','NSFW049'),
                                  46 => array('15','NSFW049'),
                                  45 => array('nsfw45','NSFW049'),
                                  44 => array('13','NSFW049'),
                                  41 => array('3','NSFW049')),
                                  
                  'ep' => array(179 => array('ep179','EP179'),
                                178 => array('ep178','EP178'),
                                177 => array('ep177','EP177'),
                                176 => array('ep176','EP176'),
                                169 => array('ep169','EP169'),
                                168 => array('ep168','EP168')),
                               
                  'wrint' => array(103 => array('wrint-20103','WRINTheit 24'),
                                   099 => array('wrint23','WRINTheit 23'),
                                   095 => array('wrintheit22','WRINTheit 22'),
                                   092 => array('wrintheit21','WRINTheit 21 '),
                                   083 => array('wrintheit20','WRINTheit 20'),
                                   078 => array('Wrintheit-XIX','WRINTheit 19'),
                                   070 => array('Wrintheit-XVIII','WRINTheit 18'),
                                   068 => array('Wrintheit-XVII','WRINTheit 17'),
                                   056 => array('wrint16','WRINTheit 16'),
                                   053 => array('wrintheit15','WRINTheit 15'),
                                   049 => array('wrintheit14','WRINTheit 14'),
                                   046 => array('wrint13','WRINTheit 13'),
                                   041 => array('12','WRINTheit 12'),
                                   038 => array('7','WRINTheit 11'),
                                   034 => array('4','WRINTheit 10'),
                                   033 => array('2','WRINTheit 9')
                                   )
                  );

foreach($podcasts as $podcastname => $podcast)
  {
    $i = 0;
    foreach($podcast as $episodenr => $padname)
      {
        //echo $i.' - '.$podcastname.' - '.$episodenr.' - '.$padname."\n";
        //$i++;
        
        $url = 'https://shownotes.piratenpad.de/ep/pad/export/'.$padname[0].'/latest?format=html';
        $datei = fopen($url, "rb");
        $inhalt = stream_get_contents($datei);
        fclose($datei);
        if (!empty($inhalt))
          {
            $filename = './podcasts/'.$podcastname.'/'.$episodenr.'.'.$padname[1].'.html';
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
