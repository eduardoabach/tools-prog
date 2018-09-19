<?php

header("X-Accel-Buffering: no"); // disable ngnix webServer buffering
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
ob_end_flush();  // close PHP output buffering
$inc=0;

$conn = pg_pconnect("host=10.1.1.21 dbname=ipag_20180322 user=postgres password=postgres");
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}

pg_query($conn, 'LISTEN "home";');

while(true){
	
	$notify = pg_get_notify($conn);
	if (!$notify) {
		//echo "id: $inc\ndata: no message\n\n";
	} else {
		$inc++;
		$msg = $notify['payload'];
		// $msg['msg'] = utf8_encode($msg['msg']);
		// $msg['nick'] = utf8_encode($msg['nick']);

		//message: {"message":"MSG_NOTIFY","pid":1674,"payload":"{"id":14,"msg":"teste x8"}"}
		//message: "{"id":15,"msg":"teste x9"}"
		// print_r(json_encode($msg));
		// die('x');
		echo "id: $inc\ndata: ".json_encode($msg)."\n\n";
	}

	flush();
	// sleep(1);
	// espera 0,4 segundos, portanto 400ms
	usleep(400000);
}

?>