<?php 
	header('Content-Type: application/json');
	function hashfilename($filename) {
		$tmp = rawurldecode($filename);
		$tmp = basename($tmp);
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
	$mins = intval($_POST['mins']);
	$secs = intval($_POST['secs']);
	$msecs = intval($_POST['msecs']);
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$dir = "thumbs/" . hashfilename($_POST['file']) . "/";
	$filename = $dir . $mins . "_" . $secs . "_" . $msecs . ".png";
	mkdir($dir, 0777, true); // make sure the folder exists
	$success = file_put_contents($filename, $data);
	$ret = array('mins' => $mins, 'secs' => $secs, 'msecs' => $msecs, "filename" => $filename);
	echo json_encode($ret);
?>