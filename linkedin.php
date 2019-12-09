<?php
$ch = curl_init();
$url = "https://api.github.com/repos/miw05/directory/contents/peoples.json";
// configuration des options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: token " . TOKEN]);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);


// exécution de la session
$data = curl_exec($ch);
var_dump(curl_error($ch));
$personalInfos = json_decode(base64_decode(json_decode($data)->content));
echo '<table>
<thead><th>Nom</th><th>Github</th><th>Coord</th><th>Promo</th></thead><tbody>';
foreach ($personalInfos as $key){
//    var_dump($key);
    if((!(isset($key->name))) || (!(isset($key->github))) || (!(isset($key->deskCoordinate))) || (!(isset($key->promo)))) continue;
    echo '<tr><td>'.$key->name.'</td><td>'.$key->github.'</td><td>'.$key->deskCoordinate.'</td><td>'.$key->promo.'</td></tr>';
}
echo '</tbody></table>';
// fermeture des ressources
curl_close($ch);
