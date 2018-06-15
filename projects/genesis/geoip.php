<?php

//Determine addressip from command
$ipaddress = substr($msg, 6);
//Check to see if there is an address or resort to the remote IP
if($ipaddress == "") {
$ipaddress = $_SERVER['REMOTE_ADDR'];
$addto = "<br /><b>No IP address supplied. Using " . $ipaddress . "</b><br />";
}else{
$addto = "";
}


//Define function for finding the city and state
$lines = file('http://api.hostip.info/rough.php?ip=' . $ipaddress);
//Extract city and state string 2nd line
$citystate = substr($lines[2], 6);

//Start two from the end for the state (There's a space after the state too, chop that off.)
$state = substr($citystate, -3, 2);

//Crop the last 4 off for the city (two for the state, plus comma and two spaces)
//Also, change the case.
$city = ucwords(strtolower(substr($citystate, 0, -5)));

//Change it from "Target located in" to "Target's estimated location" if it's a guess.

if (substr($lines[3], 9) == "false"){
$phrase = "<br />Target located in ";
} else {
$phrase = "<br />Target's estimated location: ";
}



$catbotreply = $addto . "IP Address Used: " . $ipaddress . $phrase . $city . ", " . $state . ".<br /> Big Brother is watching you...";

?>