<?php
header('Content-type: text/plain');

$apikey = '';

$request = strtolower($_GET['command']);
if (!$request)
{
    echo '\'&command=\' parameter not defined! (Options: \'rank\', \'stats\')';
    return;
};

$platform = strtolower($_GET['platform']);
if (!in_array($platform, array(
    'origin',
    'xbl',
    'psn'
)))
{
    echo '\'&platform=\' parameter not correct! (Options: \'xbl\', \'psn\' or \'origin\')';
    return;
};

if ($platform == 'origin')
{
    $machine = 'PC';
};
if ($platform == 'xbl')
{
    $machine = 'X1';
};
if ($platform == 'psn')
{
    $machine = 'PS4';
};

$player = $_GET['nick'];
if (!$player)
{
    echo '\'&nick=\' parameter not defined!';
    return;
};

function _getJSON($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json, text/plain, */*', 'Authorization: Ubi_v1 t='.apcu_fetch('uplayconnect_ticket'), 'Ubi-AppId: 39baebad-39e5-4552-8c25-2c9b919064e2', 'Connection: keep-alive', 'Keep-Alive: timeout 0, max 0'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // so curl_exec returns data
    // grab URL and pass it to the browser; store returned data
    $curlRes = curl_exec($ch);

    if (curl_errno($ch))
    {
        echo 'Error:' . curl_error($ch);
    }

    // close cURL resource, and free up system resources
    curl_close($ch);
    // Decode returned JSON so it can be handled as a multi-dimensional associative array
    return json_decode($curlRes, true);
};

// Romanize numbers for better aesthetic
function romanize($num)  
{ 
    // Be sure to convert the given parameter into an integer
    $n = intval($num);
    $result = ''; 
 
    // Declare a lookup array that we will use to traverse the number: 
    $lookup = array(
        'IV' => 4, 'III' => 3, 'II' => 2, 'I' => 1
    ); 
 
    foreach ($lookup as $roman => $value)  
    {
        // Look for number of matches
        $matches = intval($n / $value); 
 
        // Concatenate characters
        $result .= str_repeat($roman, $matches); 
 
        // Substract that from the number 
        $n = $n % $value; 
    } 

    return $result; 
}; 

if ($request == 'stats')
{

    $data = _getJSON('https://api.mozambiquehe.re/bridge?version=4&platform=' . $machine . '&player=' . $player . '&auth=' . $apikey);

    // Total Apex Kills
    $kills = intval($data['total']['kills']['value']);
    // Total Apex Dmg
    $dmg = intval($data['total']['damage']['value']);
    // Total Apex Games Played
    $games_played = intval($data['total']['games_played']['value']);
    // Current Apex Level
    $lvl = intval($data['global']['level']);
    // Kill/Death Ratio
    $adr = round($dmg / $games_played, 2);

    echo "$player Stats: Lv. " . $lvl . " | Lifetime Kills: " . $kills . " | Lifetime Damage: " . $dmg . " | Games Played: " . $games_played . " | ADR: " . $adr . " ";
};

if ($request == 'rank')
{
	$data = _getJSON('https://api.mozambiquehe.re/bridge?version=4&platform=' . $machine . '&player=' . $player . '&auth=' . $apikey);
     
	$rdiv = intval($data['global']['rank']['rankDiv']);
	 
        $rank = _getJSON('https://api.mozambiquehe.re/bridge?version=4&platform=' . $machine . '&player=' . $player . '&auth=' . $apikey);
        
        echo " $player Apex Rank: " . $rank['global']['rank']['rankName'] . " " . romanize($rdiv) .  " 「" . $rank['global']['rank']['rankScore'] . "ᴿᴾ」";

    // More Explained Rank info output
    // echo "Apex Rank: ".$result['global']['rank']['rankName']." ".$result['global']['rank']['rankDiv']." ";
    // echo "Score: ".$result['global']['rank']['rankScore'];
    
};
