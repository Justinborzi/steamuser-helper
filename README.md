# Simple Steam User Helper Functions
A verrrrrryyyyy basic php class to help people query steam profiles and format their id's
not sure why I made this the way I did and I plan to add more to this in the future to make it a full helper type class but for now this will sufice.

This class requires 2 parameter types:
- A Steam API Key
- A Steam 64 ID of a USER

you can find your api key here | https://steamcommunity.com/dev/apikey |
    as for the user id, you are required to get that yourself.

### Example Usage

```php
<?php
// Define Includes
include "assets/SteamHelper.php";

// Add the Class
use SteamFunctions\SteamHelper;

// Create new object with API KEY
$SteamUser = new SteamHelper('APIKEY');

// Call the object and method, more can be found on the wiki of this repo
$data = $SteamUser->getPlayerInfo('STEAM64ID');

// Output the formatted data
echo "<pre>";
print_r($data);
echo "</pre>";
?>
```

#### Credits
- @Justinborzi