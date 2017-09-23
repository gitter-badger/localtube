<?php
	$file = rawurlencode($_GET["file"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Player</title>
	</head>
	<body>
		<video crossorigin="anonymous" id="thevideo" src="http://<?=$_SERVER['HTTP_HOST']?>:8888/video?file=<?=$file?>" controls width=800 height=600></video>
		<script src="jquery.min.js"></script>
		<script src="player.js"></script>
	</body>
</html>