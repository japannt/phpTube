<?php
$ProjRoot = $_SERVER['DOCUMENT_ROOT'];
$allowedExt = array("mp4", "mov", "webm");

$vidExt = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
$fileVidId = md5($_FILES["fileToUpload"]["name"]);
$fileVidtmpName = $_FILES["fileToUpload"]["tmp_name"];
$targetPath = filter_var($ProjRoot . "/uploadedVideos/" . $fileVidId . "/" . "video.webm", FILTER_SANITIZE_URL);

$fileVidTitle = $_POST["videoName"];
$fileVidDesc = htmlspecialchars($_POST["videoDesc"]);
$uploaderName = $_POST["uploaderName"];

$ffmpegCommand = "ffmpeg -i $fileVidtmpName -c:v libvpx -c:a libvorbis -b:v 8M -vf scale=1280:720:force_original_aspect_ratio=decrease $targetPath";

print("please wait while we process your video...<br>");

if(in_array($vidExt, $allowedExt) && $_FILES["fileToUpload"]["size"] < 100000000 && $_FILES["fileToUpload"]["error"] == 0 && !file_exists($targetPath) && !empty($fileVidTitle)) {
	
	if(!is_dir($ProjRoot . "/uploadedVideos/" . $fileVidId . "/")) {
		mkdir($ProjRoot . "/uploadedVideos/" . $fileVidId . "/", 0777, true);
	}
	
	
	$metaFile = fopen($ProjRoot . "/uploadedVideos/" . $fileVidId . "/" . "meta.txt", "w");
	fwrite($metaFile, htmlspecialchars($fileVidTitle) . "\n");
	
	if(empty($fileVidDesc)) {
		fwrite($metaFile, "No description provided." . "\n");
	} else {
		fwrite($metaFile, str_replace("\n", "<br \>", $fileVidDesc) . "\n");
	}

	if(empty($uploaderName)) {
		fwrite($metaFile, "Anonymous\n");
	} else {
		fwrite($metaFile, $uploaderName . "\n");
	}
	fclose($metaFile);

	print("<br>- <a href=\"/api/watch.php?v=" . $fileVidId . "\">Id: " . $fileVidId . "</a>");
	system($ffmpegCommand);
}
else {
	die("<br><h1 style=\"margin:0;\">Error uploading video</h1><p style=\"margin:0;\"	>Check if the file is a valid video file<br>Check if the file is less than 100MB<br>Check if the file is not already uploaded<br>Check if the file name is not empty</p>");
}