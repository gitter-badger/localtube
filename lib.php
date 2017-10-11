<?php
	function hashfilename($filename) {
		$tmp = rawurldecode($filename);
		$tmp = basename($tmp);
		//echo $tmp;
		$tmp = str_replace("\\", "_", $tmp);
		$tmp = str_replace(" ", "_", $tmp);
		$tmp = str_replace(":", "_", $tmp);
		$tmp = str_replace(".", "_", $tmp);
		$tmp = str_replace(",", "_", $tmp);
		$tmp = str_replace("(", "_", $tmp);
		$tmp = str_replace(")", "_", $tmp);
		$tmp = str_replace("%", "_", $tmp);
		$tmp = str_replace("-", "_", $tmp);
		$tmp = str_replace("__", "_", $tmp);
		$tmp = str_replace("__", "_", $tmp);
		$tmp = str_replace("__", "_", $tmp);
		return md5($tmp);
	}
	
	function kung_mkdir($dir) {
		if (!is_dir($dir))
			mkdir($dir, 0777, true); // make sure the folder exists
	}