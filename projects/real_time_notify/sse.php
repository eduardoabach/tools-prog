<?php

header("X-Accel-Buffering: no"); // disable ngnix webServer buffering
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
ob_end_flush();  // close PHP output buffering

include('core.php');

$conn = getConection();
pg_query($conn, 'LISTEN "home";');

$inc=0;
while(true){
	
	$notify = pg_get_notify($conn);
	if (!$notify) {
		//echo "id: $inc\ndata: no message\n\n";
	} else {
		$inc++;
		$msg = $notify['payload'];

		//message: {"message":"MSG_NOTIFY","pid":1674,"payload":"{"id":14,"msg":"teste x8"}"}
		//message: "{"id":15,"msg":"teste x9"}"
		echo "id: $inc\ndata: ".json_encode($msg)."\n\n";
	}

	flush();
	// espera 0,4 segundos, portanto 400ms
	usleep(400000);
}

?>