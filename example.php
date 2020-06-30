<?php
// Define Includes
include "assets/SteamHelper.php";

// Add the Class
use SteamFunctions\SteamHelper;

// Create new object with API KEY
$SteamUser = new SteamHelper('F58F1A19E8CE9D03B1613783B185C829');

// Call the object and method
$data = $SteamUser->getPlayerInfo('76561198125156253');

// Output the formatted data
echo "<pre>";
print_r($data);
echo "</pre>";