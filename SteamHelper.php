<?php
namespace SteamFunctions;

/**
 * Creates a Dynamic class to quickly query a users profile information and reformat their community ID
 * 
 * @param String $key Requires Steam Auth Key to use this class
 * @link https://steamcommunity.com/dev/apikey
 * @category Steam
 * @author Justin Borzi <Justinborzi@gmail.com>
 * @copyright 2020 MysticSeagull
 * @version 1.0.0
 */
class SteamHelper
{
    private $key;
    private $multi;

    public function __construct(String $key = null, Array $multi = null) {
        
        if ($key != null || $key != "") {
            $this->key = $key;
        } else die ("No API key Found/And or missing. Please goto <a href='https://steamcommunity.com/dev/apikey'>Steam API</a> and generate a key.");
        // To be used later
        $this->ArrayList = $multi;
    }

    /**
     * Retrieves A Steam User's Profile
     * 
     * @param String $id which is the players SteamID
     *
     * @author Justin Borzi <Justinborzi@gmail.com>
     * @return Array Contains all user info retrieved from steam's API
    */ 
    public function getPlayerInfo($id) {
        $urls = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->key . '&steamids=' . $id;
        $table = json_decode(file_get_contents($urls), true);
        
        
        if (empty($table) || $table == "" || count($table) == 0 || !isset($table["response"]["players"][0])) {
            echo("No Data has been found, Possibly a bad UserID?");
        }

        return $table["response"]["players"][0];
    }

    /**
     * Format and converts SteamID's to 64ID
     * * Usage: 64ID formatting Ex: RESULT => 76561198125156253
     * @param String $id which is the players SteamID
     * 
     * @author Justin Borzi <Justinborzi@gmail.com>
     * @return String Returns the specified id in 64ID Format
    */ 
    public function getCommunityID($id) {
        if (preg_match('/^STEAM_/', $id)) {
            $parts = explode(':', $id);
            return bcadd(bcadd(bcmul($parts[2], '2'), '76561197960265728'), $parts[1]);
        } elseif (is_numeric($id) && strlen($id) < 16) {
            return bcadd($id, '76561197960265728');
        } else {
            return $id;
        }
    }

    /**
     * Format and converts SteamID's to SteamID
     * * Usage: SteamID formatting Ex: RESULT => STEAM_0:1:82445262
     * @param String $id which is the players SteamID
     * 
     * @author Justin Borzi <Justinborzi@gmail.com>
     * @return String Template with all user info retrieved
    */ 
    public function getSteamID($id) {
        // To be used later
        // $steam_regex = "/^STEAM_[0-5]:[01]:\d+$/";
        if (is_numeric($id) && strlen($id) >= 16) {
            $z = bcdiv(bcsub($id, '76561197960265728'), '2');
        } elseif (is_numeric($id)) {
            $z = bcdiv($id, '2');
        } else {
             return $id;
        }
        $y = bcmod($id, '2');
        
        return 'STEAM_0:' . $y . ':' . floor($z);
    }

    /**
     * Format and converts SteamID's to 32ID
     * * Usage: UserID formatting wrappers not included. Ex: RESULT => [U:1:RESULT]
     * @param String $id which is the players SteamID
     * 
     * @author Justin Borzi <Justinborzi@gmail.com>
     * @return String Template with all user info retrieved
    */ 
    public function getUserID($id) {
        if (preg_match('/^STEAM_/', $id)) {
            $split = explode(':', $id);
            return $split[2] * 2 + $split[1];
        } elseif (preg_match('/^765/', $id) && strlen($id) > 15) {
            return bcsub($id, '76561197960265728');
        } else {
            return $id;
        }
    }

}

?>