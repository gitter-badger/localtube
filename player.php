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
				position: absolute;
				left: 100px;
				top: 10px;
				font-size: 2em;
				/* not perfect difference color, sometimes its no so easy to read, but overall pretty nice... disable the fadeOut() via `enableFadeOut=false` for testing */
				mix-blend-mode: difference;
				color: rgba(0, 255, 45, 0.51);
				background-color: rgba(73, 72, 82, 0.25);
			}
		</style>
		
		<script>
			var filename = <?php echo json_encode($_GET["file"]); ?>;
		</script>
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