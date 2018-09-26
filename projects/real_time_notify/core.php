<?php

function getConection(){
	$conn = pg_pconnect("host=10.1.1.21 dbname=ipag_20180322 user=postgres password=postgres");
	if (!$conn) {
	  echo "DB error.\n";
	  exit;
	}
	return $conn;
}

function jSucess($info=array()){
	if(!is_array($info))
		$info = array('msg'=>$info);

	$info['status'] = 1;
	jResponse($info);
}

function jError($info=array()){
	$info['status'] = 0;
	jResponse($info);
}

function jResponse($info=array()){
	echo json_encode($info);
}

?>