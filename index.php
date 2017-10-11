<style>
* {
	margin: 0;
	padding: 0;
}
.thumbnail {
	display: inline;
}
</style>

<form action="#" method="get">
<input name="q">
</form>

<?php

	

	include("lib.php");
	include("thumbs.php");
	
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
	
	
	$filtertags = [];
	if (isset($_GET["q"]) && strlen(trim($_GET["q"]))) {
		echo "search for: " . $_GET["q"];
		$q = strtolower($_GET["q"]);
		$filtertags = preg_split("/[\s,|:|\\\\|.|\-|_]+/", $q); // strstr is case sensitive, so just lower $q and $file
		
	}
	
	
	$thumbs = getThumbs();
	
	echo "<ul>\n";
	
	foreach ($files as $file) {
		$file = trim($file);
		$lowerfile = strtolower($file);
		if (count($filtertags)) {
			$fail = FALSE;
			foreach ($filtertags as $filtertag) {
				if (strstr($lowerfile, $filtertag) == FALSE) {
					$fail = TRUE;
					break;
				}
			}
			if ($fail)
				continue;
			
		}
		
		
		echo "<li>";
		$path = rawurlencode($file);
		$nicename = basename($file);
		
		$tags = preg_split("/[\s,|:|\\\\|.|\-|_]+/", $file);
		$tags = array_unique($tags);
		
		$hash = hashfilename($file);
		
		echo "<a href=\"player.php?file=$path\">$nicename</a> $hash";
		
		echo "<table>";
		
		echo "<tr>";
		if (array_key_exists($hash, $thumbs)) {
			$hashthumbs = $thumbs[$hash];
			echo "<table>";
			echo "<tr>";
			foreach ($hashthumbs as $filename) {
				//echo "<td>";
				echo "<img class=\"thumbnail\" src=\"thumbs/$hash/thumbs/$filename\">";
				
			}
			echo "</table>";
			
		}
		
		echo "<tr>";
		echo "<table>";
		echo "<tr>";
		foreach ($tags as $tag) {
			
			$tag = trim($tag);
			echo "<td><button>$tag</button> ";
			
		}
		echo "</table>";
		echo "</table>";
		
		echo "\n";
	}
	echo "</ul>\n";
?>