<?php 
$data = '';

if(isset($_GET['j'])){
	$arrayDecodeJson = json_decode($_GET['j'], true);
	$data = print_r($arrayDecodeJson, true);
}

$dt = date('YmdHis');
$nameFile = 'log_'.$dt;
$file = fopen('log/'.$nameFile.'.txt', "a");
fwrite($file, $data);
fclose($file);

//create img, white point
setlocale(LC_MONETARY, 'en_GB.UTF-8'); 
$img = imagecreate(1,1);
imagecolorallocate($img, 254, 254, 254);
header("Content-type: image/gif");
imagegif($img);
imagedestroy($img);
?>
