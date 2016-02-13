<?php

$api_key="f7b8a452-ec7b-48d0-9681-fcd97a0a4321";
$curl = 0;
$response = "failed";

// Complétez $url avec l'url cible (l'url de la page que vous voulez télécharger)
switch ($_GET["action"]){
    case "getName": // $_GET["server"] , $_GET["name"]
        $url="https://".$_GET['server'].".api.pvp.net/api/lol/euw/v1.4/summoner/by-name/".$_GET["name"]."?api_key=".$api_key;
        //$url = urlencode($url);
        break;
    case "runesPages": //$_GET["server"] , $_GET["id"]
        $url="https://".$_GET['server'].".api.pvp.net/api/lol/euw/v1.4/summoner/".$_GET['id']."/runes?api_key=".$api_key;
        break;
}
// DEBUT D'ENVOIE DE LA REQUETE
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
//FIN D'ENVOIE

echo $response;
?>