<!-- API -->
<?php
require 'settings.php';
// Hetke ilma andmed
$response = CallAPI("GET", "https://api.openweathermap.org/data/2.5/weather?lat=58.924888&lon=24.868806&appid=ff6bb9d23ceac641e4f65a6e9e2ad531&units=metric", null);
//echo $response;
$response = json_decode($response);

// Järgmise päeva ennustus
$response2 = CallAPI("GET", "https://api.openweathermap.org/data/2.5/forecast?lat=58.924888&lon=24.868806&appid=ff6bb9d23ceac641e4f65a6e9e2ad531&units=metric", null);
//echo $response;
$response2 = json_decode($response2)
?>

<!-- Veebisait -->
<?php
include_once 'templates/header.php';
?>

<div class="container text-body text-center">
    <h1 id="index-text" class="font-weight-bold" style="margin-top: 15px">Praegune ilm
    </h1>
    <table class="table is-hoverable is-bordered is-fullwidth">
        <thead class="has-text-centered">
            <!-- Tabeli tegemine-->
        </thead>
        <tbody>
            <tr>
                <th>Temperatuur</th>
                <th>Tajutav</th>
                <th>Tuule suund</th>
                <th>Tuule kiirus</th>
                <th>Pilved</th>
            </tr>

            <tr>
                <td><?php echo $response->main->temp ?>℃</td>
                <td><?php echo $response->main->feels_like ?>℃</td>
                <td><?php echo $response->wind->deg ?>°</td>
                <td><?php echo $response->wind->speed ?> m/s</td>
                <td><?php echo $response->weather[0]->description ?> <img src="http://openweathermap.org/img/wn/<?php echo $response->weather[0]->icon ?>@2x.png" /></td>
            </tr>
            <tr>
                <th>Pilvisus</th>
                <th>Õhurõhk</th>
                <th>Õhuniiskus</th>
                <th>Päikesetõus</th>
                <th>Päikeseloojang</th>
            </tr>
            <tr>
                <td><?php echo $response->clouds->all ?>%</td>
                <td><?php echo $response->main->pressure ?> hPa</td>
                <td><?php echo $response->main->humidity ?>%<i class="fa-thin fa-user-pen"></i></td>
                <td><?php echo date("H:i:s",$response->sys->sunrise) ?> <i class="fas fa-sun" style="font-size: 25px; color: yellow;"></i></td>
                <td><?php echo date("H:i:s",$response->sys->sunset) ?> <i class="fas fa-moon" style="font-size: 25px; color: darkBlue;"></i></td>
            </tr>
        </tbody>
    </table>

    <!-------------------------------------------->
    <h1 id="index-text" class="font-weight-bold" style="margin-top: 30px">Järgmise 24h ilmaennustus</h1>
    <table class="table is-hoverable is-bordered is-fullwidth">
        <thead class="has-text-centered">
            <!-- Tabel-->
        </thead>
        <tbody>
            <tr>
                <th></th>
                <th>Temp</th>
                <th>Min temp <i class="fas fa-temperature-low" style="font-size: 20px; color: blue;"></i></th>
                <th>Max temp <i class="fas fa-temperature-high" style="font-size: 20px; color: red;"></i></th>
                <th>Õhurõhk</th>
                <th>Õhuniiskus</th>
                <th>Pilved</th>
            </tr>
            <?php
            //Järgmise päeva ennustuse andmed API-st
            if(isset($response2->list) && !empty($response2->list)){
                $count = 0;
                foreach($response2->list as $list){ ?>
                    <tr>
                        <th><?php echo date("d.m.Y H:i",$list->dt) ?></th>
                        <td><?php echo $list->main->temp ?>℃</td>
                        <td><?php echo $list->main->temp_min ?>℃</td>
                        <td><?php echo $list->main->temp_max ?>℃</td>
                        <td><?php echo $list->main->pressure ?> hPa</td>
                        <td><?php echo $list->main->humidity ?>%</td>
                        <td><?php echo $list->weather[0]->description ?> <img src="http://openweathermap.org/img/wn/<?php echo $list->weather[0]->icon ?>@2x.png" /></td>
                    </tr>
            <?php 
                $count ++;
                if($count == 8) // kokku 24h ennustus (mõõtmisel 3h vahe)
                    break;
                }
            }
            
            ?>
            
        </tbody>
    </table>
</div>

<?php
include_once 'templates/footer.php'
?>