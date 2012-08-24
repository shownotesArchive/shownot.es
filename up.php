<?php
//KONFIGURATION
$show_changetime=true;
$show_stat=true;
$style_file='<div style="background-color:#F08080; width:20px; float:left;">&nbsp;</div>';
$style_dir ='<div style="background-color:#8080F0; width:20px; float:left;">&nbsp;</div>';
$upload_max_file_size=15000000;
$upload_password='geheimergeheimchat';
$allowed_file_endings=array("jpg","jpeg","gif","png","bmp",".ico",".flv","avi","zip","html");
//$dir="/usr/www/users/resona/g/Bilda/";

$dir=dirname($_SERVER['SCRIPT_FILENAME']).'/';
$req_dir=dirname($_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']);
$req_file=$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
$forward_address=$_SERVER['REQUEST_URI'];

if(strpos($forward_address,'?')!==FALSE)
	$forward_address=substr($forward_address,0,strpos($forward_address,'?'));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
     "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="content-type" content="text/html; charset=ASCII"/>
<meta name="robots" content="noindex, nofollow"/>
<?php
if(isset($_GET["upload"])) {
	$upload_successfull=false;
	$name;
	if(isset($_FILES["file"]["error"]) && $_FILES["file"]["error"]==0 && $_FILES["file"]["size"]>0 && $_FILES["file"]["size"]<=$upload_max_file_size && isset($_POST["pwd"]) && $_POST["pwd"]==$upload_password) {
		$name=$_FILES["file"]["name"];
		if(isset($_POST["newFilename"]) && strlen($_POST["newFilename"])>0) {
			if(strpos($_POST["newFilename"],'.')===FALSE) {
				if(strpos($name,'.')!==FALSE) {
				  $ending=strrchr($name,'.');
				  $name=$_POST["newFilename"]."".$ending;
				  }
				else
					$name=$_POST["newFilename"];
			}else $name=$_POST["newFilename"]; 
		}
		$end=false;
		if(strpos($name,'.')!==FALSE) {
			$end_string=substr(strrchr($name,'.'),1);
			foreach($allowed_file_endings as $ending)
				if(stripos($end_string,$ending)!==FALSE) {
					$end=true;
					break;
				}
		} else $end=true;
		if(!$end) {
			$name=substr($name,0,strpos($name,'.').'.txt');
		}
		$file_location;
		if(!isset($_POST['replace']) && file_exists($dir.$name)) {
			$i=1;
			while(file_exists($dir.$i.'_'.$name))
				$i++;
			$name=$i.'_'.$name;
		}
		$file_location=$dir.$name;
		$handl0r=fopen($name,"w");
		fclose($handl0r);
		if(move_uploaded_file($_FILES["file"]["tmp_name"],$file_location))
		$upload_successfull=true;
	}
	?>
<title>Upload auf <?php echo $req_dir ?>
</title>
<meta http-equiv="refresh" content="8; URL=<?php echo $forward_address ?>">
</head>
<body>
<h1>Upload <?php if($upload_successfull) echo 'erfolgreich'; else echo 'fehlgeschlagen';?></h1>
<p>Das Hochladen der Datei <?php echo $name ?> war <?php if(!$upload_successfull) echo 'nicht ' ?>erfolgreich</p>
<p>Sie werden innerhalb von 8 Sekunden zum Index weitergeleitet</p>
<?php
}else {
?>
<title>Dateilisting von <?php echo $req_dir ?>
</title>
<style type="text/css">
td {
  padding-left:15px;
}
td.nr {
  text-align:right;
}
  td.size {
  text-align:right;
}
</style>
<script type="text/javascript" language="javascript">
function elapseFormula() {
  var form=document.getElementById("uploadFormula");
  if(form.style.display=="none")
    form.style.display="block";
   else
     form.style.display="none";
}
</script>
<?php
echo "\n</head>\n<body>\n";
echo '<p>Dateilisting evtl. unkomplett aufgrund fehlender Berechtigung</p>';
echo '<p>'.$style_file.'<span>->Datei</span></p>';
echo '<p>'.$style_dir.'<span>->Verzeichnis</span></p>';
echo '<div><a href="javascript:elapseFormula()">Hochladen</a><div id="uploadFormula" style="display:none;">
<form enctype="multipart/form-data" action="'.$forward_address.'?upload" method="POST">
<div style="float:left;">
<label for="file">Datei</label><br/>
<label for="newFilename">Neuer Dateiname</label><br/>
<label for="pwd">Passwort</label><br/>
<label for="replace">Ersetzen</label><br/>
</div><div>
<input type="hidden" name="MAX_FILE_SIZE" value="'.$upload_max_file_size.'"/><input type="file" size="50" name="file" id="uploadFile" style="width:300px;" /><br/>
<input type="text" name="newFilename" id="newFilename" size="30" value=""/><br/>
<input type="password" name="pwd" id="pwd" size="30" value=""/><br/>
<input type="checkbox" name="replace" id="replace" value=""/><br/>
<input type="submit" value="Absenden">
</div>
</form>
</div></div>';
$arr_week_days=array();
$arr_month_names=array();
function format_time($integer_time) {
	global $arr_week_days;
	global $arr_month_names;
	if(((int)$integer_time)<=0)
		return 'Nie';
	else {
		if(!isset($arr_week_days[0])) {
			$arr_week_days=array("Sontag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag");
			$arr_month_names=array("unbekannt","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
		}
		$out=$arr_week_days[(int)(date('w',$integer_time))];
		$out.=' der '.date('j',$integer_time).'. ';
		$out.=$arr_month_names[(int)(date('n',$integer_time))];
		$out.=date(" Y H:i:s",$integer_time);
		return $out;
	}
}
function format_file_size($filesize) {
	$arr=array('','K','M','G','T','P','E','Z');
	$cur=$filesize;
	for($i=0; ($cur>=1024 && $i<count($arr)); $i++)
		$cur/=1024;
	return sprintf('%8.3f',$cur).' '.$arr[$i].' Byte';
}
echo "<table border=\"0\">\n";
echo '<tr><th>Nr</th><th>Typ</th><th>Name</th><th>Gr&ouml;&szlig;e</th>'.($show_changetime?'<th>Letzte &Auml;nderung</th>':'').'</tr>';
$index=1;
$size=0;
if(is_dir($dir)) {
	if($dh=opendir($dir)) {
		while(($filename=readdir($dh))!==false) {
			$file=$dir.'/'.$filename;
			if(!($filename==='..' || $filename==='.') && (((int)substr(sprintf('%o',fileperms($file)),-1))&4)==4) {
				echo '<tr><td class="nr">'.($index++).'</td><td>';
				if(filetype($file)==='file')
					echo $style_file;
				else
					echo $style_dir;
				echo '</td><td><a href="http://'.$req_dir.'/'.$filename.'">'.$filename.'</a></td>';
				if(filetype($file)==='file') {
					$size+=filesize($file);
					echo '<td class="size" title="'.filesize($file).' Byte">'.format_file_size(filesize($file)).'</td>';
				}else
					echo '<td>&nbsp;</td>';
				if($show_changetime)
					echo '<td class="chtime">'.format_time(filemtime($file)).'</td>';
				echo '</tr>';
				echo "\n";
			}
		}
		closedir($dh);
	}
}
echo "</table>\n";
if($show_stat) {
	echo "<p title=\"".$size." Byte\">Gesamtgr&ouml;&szlig;e: ".format_file_size($size)."</p>\n";
	echo "<p>Anzahl aller Dateien: ".($index-1)."</p>";
}
}
echo "</body>\n</html>";
?>
