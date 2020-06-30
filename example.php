<?php
// Define Includes
include "assets/SteamHelper.php";

// Add the Class
use SteamFunctions\SteamHelper;

// Create new object with API KEY
$SteamUser = new SteamHelper('APIKEY');

// Call the object and method
$data = $SteamUser->getPlayerInfo('STEAMID');

// Output the formatted data
echo "<pre>";
print_r($data);
echo "</pre>";
