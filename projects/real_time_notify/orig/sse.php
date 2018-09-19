<?php
$dbconn = new PDO("pgsql:host=localhost;dbname=mydb", "pduser", "userpass");
$dbconn->exec('LISTEN "channel_name"');   // those doublequotes are very important

header("X-Accel-Buffering: no"); // disable ngnix webServer buffering
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
ob_end_flush();  // close PHP output buffering
$inc=0;

while (true) {
	$result = "";
	// wait for one Notify 10seconds instead of using sleep(10)
	$result = $dbconn->pgsqlGetNotify(PDO::FETCH_ASSOC, 10000);

	if ( $result ) {
        echo "id: $inc\ndata: ".stripslashes(json_encode($result))."\n\n";
        $inc++;
	}

  flush();
}

?>