<?php

include './cache.php';

if(!isset($_GET['preview']))
	{
		if (!$handle = fopen($filename, 'w'))
			{
				echo 'Cannot open file '.$filename;
				exit;
			}
		else
			{
				echo 'open file: success'."\n";
				@sleep(1);
			}

		if (fwrite($handle, $inhalt) === FALSE)
			{
				echo 'Cannot write to file '.$filename;
				exit;
			}
		else
			{
				echo 'write file: success'."\n";
				@sleep(1);
			}
		fclose($handle);

		@sleep(1);
		echo 'finish'."\n";
	}
else
	{
		echo $inhalt;
		@sleep(1);
	}

?>