<?php
	$ProjRoot = $_SERVER['DOCUMENT_ROOT'];
	$vidId = $_GET["v"];

	if(!is_dir($ProjRoot . "/uploadedVideos/" . $vidId . "/")) {
		die("No video with that id exists");
	}


	$metaFile = fopen($ProjRoot . "/uploadedVideos/" . $vidId . "/" . "meta.txt", "r");
	$vidTitle = fgets($metaFile);
	$vidDesc = fgets($metaFile);
	$uploaderName = fgets($metaFile);
	fclose($metaFile);
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="title" content="phpTube">
		<meta name="description" content="watch <?php print(rtrim($vidTitle, "\r\n")) ?> on phpTube">
		<meta name="author" content="<?php $uploaderName ?>">

		<link rel="stylesheet" href="/css/watchpage.css">
		<title><?php echo $vidTitle; ?> - phpTube</title>
	</head>

	<body>
		<ul>
			<li><a href="/">home</a></li>
			<li><a href="/upload">upload</a></li>
			<li><a href="/about">about</a></li>
		</ul>
		
		<div class="video-container">
			<video controls autoplay>
				<source src="/uploadedVideos/<?=$vidId . "/video.webm" ;?>">
			</video>
			<h1 style="padding: 0; margin: 0;">
				<?=$vidTitle;?>
			</h1>
			<code>
				<?=$vidDesc;?>
			</code>
			<p>
				Uploaded by: <?=$uploaderName;?>
			</p>
		</div>
	</body>
</html>