<?php
header('Content-type: text/plain');

$apikey = '';

$platform = strtolower($_GET['platform']);
	if (!in_array($platform, array('origin', 'xbl', 'psn'))) { echo '\'&platform=\' parameter not correct! (Options: \'xbl\', \'psn\' or \'origin\')'; return; };

	if ($platform == 'origin') {
		$machine = 'PC';
	};
	if ($platform == 'xbl') {
		$machine = 'X1';
	};
	if ($platform == 'psn') {
		$machine = 'PS4';
	};

$player = $_GET['nick'];
	if (!$player) { echo '\'&nick=\' parameter not defined!'; return; };

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.mozambiquehe.re/bridge?version=4&platform='.$machine.'&player='.$player.'&auth='.$apikey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = json_decode(curl_exec($ch), true);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

echo " $player Apex Rank: ".$result['global']['rank']['rankName']." ".$result['global']['rank']['rankDiv']." || ".$result['global']['rank']['rankScore'];

// More Explained Rank info output
// echo "Apex Rank: ".$result['global']['rank']['rankName']." ".$result['global']['rank']['rankDiv']." ";
// echo "Score: ".$result['global']['rank']['rankScore'];
