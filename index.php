<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
		<style>
			iframe {
				width:100%;
				height:500px;
				overflow:hidden;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Coder Dojo Stirling Meme Showcase</h1>
			<hr/>
<?php

define('MEMES_DIR', 'memes');
define('MEMES_PER_ROW', 2);
define('BOOTSTRAP_SPAN_CLASS', "col-md-".(12/MEMES_PER_ROW));

function memeTitle($memeFile) {
    $fp = file_get_contents($memeFile);
    if (!$fp) 
        return $memeFile;

    $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
    if (!$res) 
    {
        return $url; 
    }
    else
    {
    	return $title_matches[1];
    }
}

$memeFiles = array();
if ($handle = opendir('memes')) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'html')
        {
            array_push($memeFiles, MEMES_DIR.'/'.$file);
        }
    }
    closedir($handle);

    if (count($memeFiles) > 0)
    {
	    $chunkedMemeFiles = array_chunk($memeFiles, MEMES_PER_ROW);

	    foreach ($chunkedMemeFiles as $memeFilesChunk)
	    {
	    	echo '<div class="row">';
	    	foreach ($memeFilesChunk as $memeFile)
	    	{
	    		echo '<div class="'.BOOTSTRAP_SPAN_CLASS.'">
	    				<h2><a href="'.$memeFile.'">'.memeTitle($memeFile).'</a></h2>
	    				<iframe scrolling="no" src="'.$memeFile.'"></iframe>
	    			</div>';
	    	}
	    	echo '</div>';
	    }
	}
	else
	{
		echo "<p>Uh oh! No memes found.</p>";
	}
}
?>
		</div> <!-- end container -->
	</body>
</html>