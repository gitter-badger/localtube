<?php

	$path = "E:\\2017\\";
	$files = glob("$path*\\*.mp4");
	
	$filestext = implode("\n", $files);
	file_put_contents("database/files.txt", $filestext);