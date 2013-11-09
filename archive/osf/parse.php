<?php

function is_feed() {
  return false;
}
function get_the_ID() {
  return '1';
}

function parseWrapper($pad) {
  $encodedData = str_replace(' ','+',$pad);
  $shownotesString = str_replace("\n", " \n", "\n" . base64_decode($encodedData) . "\n");
  $shownotesString = $pad;

  $mode = 'shownot.es';

  $shownotes_options['main_delimiter'] = '';
  $shownotes_options['main_last_delimiter'] = '';
  $osf_starttime = 0;

  $fullmode             = 'true';
  $fullint              = 2;
  $tags                 = explode(' ', 'chapter section spoiler topic embed video audio image shopping glossary source app title quote link podcast news');
  $data['tags']         = $tags;
  $data['fullmode']     = $fullmode;
  $data['amazon']       = 'shownot.es-21';
  $data['thomann']      = '93439';
  $data['tradedoubler'] = '16248286';

  $shownotesArray = osf_parser($shownotesString, $data);

  $return['podcast'] = osf_get_podcastname($shownotesArray['header']);
  $return['episode'] = str_replace($return['podcast'], '', osf_get_episodenumber($shownotesArray['header']));
  $return['shownoter'] = osf_get_persons('shownoter', $shownotesArray['header']);
  $return['podcaster'] = osf_get_persons('podcaster', $shownotesArray['header']);
  $return['episodetime'] = osf_get_episodetime($shownotesArray['header']);

  $return['json'] = json_encode($shownotesArray['export']);
  $return['chapter'] = osf_export_chapterlist($shownotesArray['export']);
  return $return;
}

?>