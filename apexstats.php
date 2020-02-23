<?php
header('Content-type: text/plain');

$apikey = '';
$platform = 'PC';
$player = 'Rehkloos';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.mozambiquehe.re/bridge?version=4&platform='.$platform.'&player='.$player.'&auth='.$apikey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = json_decode(curl_exec($ch), true);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

echo " $player Apex Rank: ".$result['global']['rank']['rankName']." ".$result['global']['rank']['rankDiv']." || ".$result['global']['rank']['rankScore'];

// More Explained Rank info output
// echo "Apex Rank: ".$result['global']['rank']['rankName']." ".$result['global']['rank']['rankDiv']." ";
// cho "Score: ".$result['global']['rank']['rankScore'];
