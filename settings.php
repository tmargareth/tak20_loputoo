<!----------------------------------------------- CONFIG -------------------------------------------->
<?php
// Andmebaasiga ühenduse saamiseks on vaja alati config fail kirjutada /** */

define("HOST", "localhost");   // konstandi nimi (trükitähtedega), enda väljamõeldud - ei saa muuta, peale koma talle antud väärtus - hetkel string
define("USERNAME", "username"); // kasutajanimi antud keskkonnas;  kopeeri rida - Alt + Shift + nool
define("PASSWORD", "password");   // kasutajanimi antud keskkonnas ja järgmine parool
define("DBNAME", "dbname"); // andmebaasi nimi, vaata, et oleks sama ka .sql failides

$dsn = "mysql:host=".HOST.";dbname=".DBNAME; // muutuja; ühenduse jaoks, enda väljamõeldud, . jätkamiseks
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); // vigade kinni püüdmiseks; PDO - klass php-s
?>

<!----------------------------------------------- COMMON -------------------------------------------->
<?php 
// Muudab HTML märgid turvaliseks 
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

// Näita massiivi kenamal kujul
function show($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
?>

<!----------------------------------------------- API -------------------------------------------->
<?php
// Hetke ilma andmed
$response = CallAPI("GET", "https://api.openweathermap.org/data/2.5/weather?lat=58.924888&lon=24.868806&appid=[ENTER YOUR KEY HERE]&units=metric", null);
//echo $response;
$response = json_decode($response);

// Järgmise päeva ennustus
$response2 = CallAPI("GET", "https://api.openweathermap.org/data/2.5/forecast?lat=58.924888&lon=24.868806&appid=[ENTER YOUR KEY HERE]&units=metric", null);
//echo $response;
$response2 = json_decode($response2)
?>

<?php
function CallAPI($method, $url, $data)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
