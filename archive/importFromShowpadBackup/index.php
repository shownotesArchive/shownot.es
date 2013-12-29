#!/usr/bin/php
<?php
  $docs = json_decode(file_get_contents("./metadata/bak-docs.json"));
  $i = 0;
  foreach ($docs as $doc) {
    if($doc->group == 'pod' && $doc->createTime != 0) {
      if(filesize('./docdata/bak-'.$doc->docname.'.json') > 400) {
        echo "\n".$doc->docname;
        rename('./docdata/bak-'.$doc->docname.'.json', './backups/bak-'.$doc->docname.'.json');
        $i++;
      }
    }
  }
  echo "\n".'Episodes: '.$i;
?>