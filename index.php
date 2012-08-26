<?php
function getEpisodes($Podcast)
	{
		if ($handle = @scandir('./podcasts/'.$Podcast, 1))
			{
				foreach($handle as $file)
					{
						if ($file != "." && $file != "..")
							{
								$Episode = explode('.', $file);
								echo '<li><a onclick="TINY.box.show({url:\'./podcasts/'.$Podcast.'/'.$file.'\'})">'.(2 < count($Episode) ? $Episode[1] : $Episode[0]).'</a></li>';
							}
					}
			}
		else
			{
				echo "<li>Verzeichnis leer</li>";
			}
	}
//<li><a onclick="TINY.box.show({url:'./podcasts/ll/12_07_12.html'})">12.07.2012</a></li>
?><!DOCTYPE html>
<html lang="de"> 

<head>
	<meta charset="utf-8" />
	<title>Die Shownotes</title>
	<meta name="viewport" content="width=980" />  
	<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
	<link rel="icon" type="image/x-icon" href="./favicon.ico" />
	<link rel="stylesheet" href="http://cdn.shownot.es/css/style.css" type="text/css" />
	<link rel="stylesheet" href="http://cdn.shownot.es/css/baf.css" type="text/css"  media="screen" />
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
			Wir sind eine Community, die Shownotes f&uuml;r verschiedene Podcast- und Radioformate live mitnotiert. Du befindest dich gerade auf unserer tempor&auml;ren &uuml;bergangsseite. Wir planen momentan, eine eigene Software zu modifizieren und in Betrieb zu nehmen, um das Schreiben von Shownotes zu erleichtern. <a href="http://i.minus.com/jcoBKNlPtJ5Lp.png">Hier</a> dazu eine kleine Vorschau. Bis dahin erreicht ihr die Pads nach wie vor &uuml;ber <a href="https://shownotes.piratenpad.de/"><strong>shownotes.piratenpad.de</strong></a>.
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
						<?php echo getEpisodes('wrint'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://www.fritz.de/media/podcasts/sendungen/blue_moon.html">Blue&nbsp;Moon</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('bm'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://blogs.hr-online.de/lateline/podcast/">LateLine</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('ll'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://chaosradio.ccc.de/chaosradio.html">Chaosradio</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('cr'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://not-safe-for-work.de">Not Safe For Work</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('nsfw'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://einschlafen-podcast.de">Einschlafen&nbsp;Podcast</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('ep'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://mobilemacs.de/">mobileMacs</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('mm'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://monoxyd.de/category/dieweisheit">Der&nbsp;Weisheit</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('dw'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://www.jobscast.de">Jobscast</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('jc'); ?>
				</ul>
			</div>
			<div class="g-button-group">
				<a class="g-button" href="http://ponytime.net/">Ponytime</a>
				<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
						<?php echo getEpisodes('pt'); ?>
				</ul>
			</div>
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
		<p>Der Großteil der Entwicklung erfolgt auf <a href="https://github.com/">GitHub</a>. Jeder der mithelfen will, kann gerne Pull-Requests an die Repositorys <a href="https://github.com/SimonWaldherr/shownot.es">GitHub.com/SimonWaldherr/shownot.es</a>, <a href="https://github.com/mluto/ShowPad">GitHub.com/mluto/ShowPad</a> sowie <a href="https://github.com/mluto/etherpad-lite">GitHub.com/mluto/etherpad-lite</a> schicken.</p>
		<hr />
		<p>Wer Podcasts mag, sollte <a href="http://podpott.de/">Podpott</a> und <a href="http://hoersuppe.de/">die H&ouml;rsuppe</a> kennen.</p>
	</div>

	<div class="footer">&nbsp;<span>&copy; 2012 <a href="/">shownot.es</a></div>

</div>
<script type="text/javascript" src="http://cdn.shownot.es/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="http://cdn.shownot.es/js/tinybox.js"></script>
</body>

</html>
