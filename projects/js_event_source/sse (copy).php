<?php
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream\n\n");
$counter = rand(1, 10);
while (1) {
// 1 is always true, so repeat the while loop forever
  echo "event: ping\n";
  $curDate = date(DATE_ISO8601);
  echo 'data: {"time": "' . $curDate . '"}';
  echo "\n\n";
  // Send a simple message at random intervals.
  $counter--;
  if (!$counter) {
    echo 'data: This is a message at time ' . $curDate . "\n\n";
    $counter = rand(1, 10);
  }
  // flush the output buffer and send echoed messages to the browser
  while (ob_get_level() > 0) {
    ob_end_flush();
  }
  flush();
  // sleep for 1 second before running the loop again
  sleep(1);
}