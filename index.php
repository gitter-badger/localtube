<?php
	$path = "E:\\2017\\";
	$files = glob("$path*\\*.mp4");
	echo "<ul>\n";
	foreach ($files as $file) {
		echo "<li>";
		$path = rawurlencode($file);
		$nicename = basename($file);
		echo "<a href=\"player.php?file=$path\">$nicename</a>";
		echo "\n";
	}
	echo "</ul>\n";
?>