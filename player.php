<?php
	$file = rawurlencode($_GET["file"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Player</title>
		<style>
			#overlaytext {
				background-color: rgba(50, 56, 55, 0.26);
				position: absolute;
				left: 100px;
				top: 10px;
				color: rgba(140, 125, 125, 0.69);
				font-size: 6em;
			}
		</style>
	</head>
	<body>
		<div id="overlaytext"></div>
		<video crossorigin="anonymous" id="thevideo" src="http://<?=$_SERVER['HTTP_HOST']?>:8888/video?file=<?=$file?>" controls width=800 height=600></video>
		<script src="jquery.min.js"></script>
		<script src="player.js?<?=time();?>"></script>
		<script>

		</script>
	</body>
</html>