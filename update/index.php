<?php
$starttime = microtime(1);
ob_start();

function getEpisodes($Podcast, $count)
	{
		if ($handle = @scandir('./../podcasts/'.$Podcast, 1))
			{
				foreach($handle as $file)
					{
						if ($file != "." && $file != "..")
							{
								$Episode = explode('.', $file);
								echo '<li><a onclick="TINY.box.show({url:\'./podcasts/'.$Podcast.'/'.$file.'\'}); return false" href="./podcasts/sn/'.$Podcast.'/'.$file.'">'.(2 < count($Episode) ? $Episode[1] : $Episode[0]).'</a></li>';
								++$count;
							}
					}
			}
		else
			{
				echo "<li>Verzeichnis leer</li>";
			}
		return $count;
	}

?><!DOCTYPE html>
<html lang="de"> 

<head>
	<meta charset="utf-8" />
	<title>Die Shownotes</title>
	<meta name="viewport" content="width=980" />  
	<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
	<link rel="icon" type="image/x-icon" href="./favicon.ico" />
	<link rel="stylesheet" href="http://cdn.shownot.es/css/style.min.css?v=003" type="text/css" />
	<link rel="stylesheet" href="http://cdn.shownot.es/css/baf.min.css?v=003" type="text/css"  media="screen" />
	<link rel="author" href="./humans.txt" />
	<link rel="apple-touch-startup-image" href="http://cdn.shownot.es/img/iPhonePortrait.png" />
	<link rel="apple-touch-startup-image" sizes="768x1004" href="http://cdn.shownot.es/img/iPadPortait.png" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>
</head>

<body>
<div class="content">
	<div class="header">
		<div class="title"><a href="/"><img src="http://cdn.shownot.es/img/logo.png">Die Shownotes</a></div>
	</div>
	<div class="box" id="main">
		<div class="title">Hallo!</div>
		<p style="margin-top: 1em;">
			Wir sind eine Community, die Shownotes f&uuml;r verschiedene Podcast- und Radioformate live mitnotiert. Du befindest dich gerade auf unserer tempor&auml;ren &Uuml;bergangsseite. Wir planen momentan, eine eigene Software zu modifizieren und in Betrieb zu nehmen, um das Schreiben von Shownotes zu erleichtern. <a href="http://i.minus.com/jcoBKNlPtJ5Lp.png">Hier</a> dazu eine kleine Vorschau. Bis dahin erreicht ihr die Pads nach wie vor &uuml;ber <a href="https://shownotes.piratenpad.de/"><strong>shownotes.piratenpad.de</strong></a>.
		</p><hr><br><div id="podcasts">
		<p style="margin-top: 1em;">
			Wir schreiben aktuell f&uuml;r folgende Podcasts mehr oder weniger regelm&auml;ßig die Shownotes:
		</p>
		<div style="margin-top: 1em;">
			<div class="g-button-group">
				<a class="g-button" href="http://www.wrint.de/">WRINT</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('wrint', 0); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://www.fritz.de/media/podcasts/sendungen/blue_moon.html">Blue&nbsp;Moon</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('bm', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://blogs.hr-online.de/lateline/podcast/">LateLine</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('ll', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://chaosradio.ccc.de/chaosradio.html">Chaosradio</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('cr', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://not-safe-for-work.de">Not Safe For Work</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('nsfw', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://einschlafen-podcast.de">Einschlafen&nbsp;Podcast</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('ep', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://mobilemacs.de/">mobileMacs</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('mm', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://monoxyd.de/category/dieweisheit">Der&nbsp;Weisheit</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('dw', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://www.jobscast.de">Jobscast</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('jc', $i); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://ponytime.net/">Ponytime</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php $i = getEpisodes('pt', $i); ?>
				</ul>
			</div>
			<!--<p>Zu diesen Podcasts gibt es bei uns insgesamt <?php echo $i; ?> Shownote Eintr&auml;ge. <br>Die gesamte Liste der Shownotes ist im <a href="https://shownotes.piratenpad.de/ep/padlist/all-pads">Etherpad</a> zu finden.</p>--><br>
		</div></div>

		<hr />
		<p>
			Um unsere Vorhabungen zu finanzieren, sind wir nach wie vor auf eure Spenden angewiesen. Daher w&uuml;rde es uns freuen, wenn ihr uns ab und zu <a href="https://flattr.com/thing/713059/dieshownotes-on-Twitter">flattern</a> k&ouml;nntet. Mit <a href="http://superfav.com/">SuperFav</a> werden &uuml;brigens <a href="http://twitter.com/dieshownotes">alle Tweets</a> automatisch geflattert.
		</p>
		<p style="margin-top: 1em">Zus&auml;tzliche Informationen sind &uuml;ber unsere Twitter Accounts zu erhalten: <a href="http://twitter.com/dieshownotes">@DieShownotes</a>, <a href="http://twitter.com/quimoniz">@Quimoniz</a>, <a href="http://twitter.com/gurkitier">@Gurkitier</a>, <a href="http://twitter.com/kaeffchen_heinz">@kaeffchen_heinz</a>, <a href="http://twitter.com/simonwaldherr">@SimonWaldherr</a>.</p>
		<p style="margin-top: 1em;">
			Neben Twitter k&ouml;nnt ihr uns auch im IRC auf <a href="irc://irc.freenode.net/shownotes">freenode</a> erreichen. (<a href="http://webchat.freenode.net/?channels=shownotes">Webchat</a>)
		</p>
		<hr />
		<p>Der Großteil der Entwicklung erfolgt auf <a href="https://github.com/">GitHub</a>. Jeder der mithelfen will, kann gerne Pull-Requests an die Repositorys <a href="https://github.com/SimonWaldherr/shownot.es">GitHub.com/SimonWaldherr/shownot.es</a>, <a href="https://github.com/SimonWaldherr/OpenShownotesFormat">GitHub.com/SimonWaldherr/OpenShownotesFormat</a>, <a href="https://github.com/mluto/ShowPad">GitHub.com/mluto/ShowPad</a> sowie <a href="https://github.com/mluto/etherpad-lite">GitHub.com/mluto/etherpad-lite</a> schicken.</p>
		<hr />
		<p>Wer Podcasts mag, sollte <a href="http://podpott.de/">Podpott</a> und <a href="http://hoersuppe.de/">die H&ouml;rsuppe</a> kennen.</p>
	</div>
	<!--<div class="box" style="display:none; visibility: hidden;">-->
	<div class="box">
		<?php 
			
			ini_set('allow_url_fopen', '1');
			$filename = "http://cdn.simon.waldherr.eu/projects/easySQL/cachetweets/?tweet=DieShownotes&limit=42";
			$ch = curl_init();
			$timeout = 0;
			curl_setopt ($ch, CURLOPT_URL, $filename);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
			echo $file_contents;
			
		?>
	</div>
	<div class="footer">&nbsp;<span>&copy; 2012 <a href="/">shownot.es</a></div>

</div>
<script type="text/javascript" src="http://cdn.shownot.es/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="http://cdn.shownot.es/js/tinybox.js"></script>
</body>

</html>
<?php

$inhalt = ob_get_contents();
ob_end_clean();

$generatetime = microtime(1)-$starttime;
$cache_refresh = 3600;
if (!empty($inhalt))
{
	$filename = './../index.php';
	$inhalt = explode('<body>', $inhalt);
	$inhalt = $inhalt[0].'<body><!-- '."\n".'zuletzt aktualisiert um: '.time().' ('.date("H:i:s d.m.Y").")\n".'Generierungsdauer: '.$generatetime.' sec'."\n".'-->'.$inhalt[1];
	
	$code = '<?php if('.(time()+$cache_refresh).' < time()){'."\n".'Header( "HTTP/1.1 302 Found" );'."\n".'Header( "Location: http://shownot.es/update/" );} ?>';
	
	$inhalt = $code.$inhalt;
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

	fclose($handle);
	
	@sleep(1);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://shownot.es/");
	header("Connection: close");
}
?>
