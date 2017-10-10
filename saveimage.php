<?php 
	header('Content-Type: application/json');
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
	
	// Quality is a number between 0 (best compression) and 100 (best quality)
	function png2jpg($img, $outputFile, $quality) {
		$image = imagecreatefromstring($img);
		if ($image == false)
			return false;
		imagejpeg($image, $outputFile, $quality);
		imagedestroy($image);
		return true;
	}
	
	// Example 2160p image:
	// JPG> usually in the range of 150-600kb with quality=90
	// PNG> around 6MB
	$convertToJPG = true;
	$extension = $convertToJPG ? "jpg" : "png";
	
	$mins = intval($_POST['mins']);
	$secs = intval($_POST['secs']);
	$msecs = intval($_POST['msecs']);
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$dir = "thumbs/" . hashfilename($_POST['file']) . "/";
	$filename = $dir . $mins . "_" . $secs . "_" . $msecs . "." . $extension;
	if (!is_dir($dir))
		mkdir($dir, 0777, true); // make sure the folder exists
	
	$success = false;
	if ($convertToJPG)
		$success = png2jpg($data, $filename, 90);
	else
		$success = file_put_contents($filename, $data);
	
	$filesize = 0;
	if ($success)
		$filesize = filesize($filename);
	
	$ret = array('mins' => $mins, 'secs' => $secs, 'msecs' => $msecs, "filename" => $filename, "status" => $success, "filesize" => $filesize);
	echo json_encode($ret);
?>