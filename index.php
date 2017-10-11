<style>
.thumbnail {
	/*display: inline;*/
	
}
</style>

<?php
	include("lib.php");

	$files = file("database/files.txt");
	
	function getThumbs() {
		$list = file("database/thumbs.txt");
		$map = array();
		foreach ($list as $line) {
			$parts = explode("/", $line);
			$hash = $parts[1];
			$name = $parts[2];
			$map[$hash][] = $name;
			
		}
		//var_dump($map);
		return $map;
	}
	
	$thumbs = getThumbs();
	
	echo "<ul>\n";
	foreach ($files as $file) {
		$file = trim($file);
		echo "<li>";
		$path = rawurlencode($file);
		$nicename = basename($file);
		
		$tags = preg_split("/[\s,|:|\\\\|.|\-|_]+/", $file);
		
		$hash = hashfilename($file);
		
		echo "<a href=\"player.php?file=$path\">$nicename</a> $hash";
		
			echo "<table>";
		
		
		if (array_key_exists($hash, $thumbs)) {
			$hashthumbs = $thumbs[$hash];
			echo "<tr>";
			foreach ($hashthumbs as $filename) {
				echo "<td>";
				echo "<img class=\"thumbnail\" src=\"thumbs/$hash/thumbs/$filename\"><br>";
				
			}
			
		}
		
		echo "<tr>";
		foreach ($tags as $tag) {
			$tag = trim($tag);
			echo "<td><button>$tag</button> ";
			
		}
			echo "</table>";
		
		echo "\n";
	}
	echo "</ul>\n";
?>