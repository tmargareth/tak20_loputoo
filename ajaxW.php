<?php
require "settings.php";

if(isset($_POST['sel_date'])){

    $day = date('m-d', strtotime($_POST['sel_date']));
    $year = date('Y', strtotime($_POST['sel_date']));
    $month = date('m', strtotime($_POST['sel_date']));
    $yeardata = [$year,$year - 1, $year - 2]; // 2022, 2021, 2020
    $timedata = ['06:00','07:00','08:00','09:00','12:00','13:00','14:00','15:00','19:00','20:00','21:00'];
    $tempdata = [];
    foreach($yeardata as $yd){
        $date = $yd.'-'.$day ." 06:00";
        $date2 = $yd.'-'.$day ." 22:59";
        $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
        $connection->exec("SET NAMES utf8");
        $sqlWest = "SELECT celsius, added from ilm_ds18_out_west where added BETWEEN  '".$date."' AND '". $date2."'";
        $statement = $connection->prepare($sqlWest); // valmistab sql-i ette
        $statement->execute(); // Käivita SQL lause koos muutujatega
        $result = $statement->fetchAll();
        $row22 = ($result);
        
        foreach($row22 as $data){
            $key = date('H',strtotime($data['added'])).':00';
            if(in_array($key, $timedata)){
                $min = date('i',strtotime($data['added']));
                if($min <= 4){ // Kui minutid on 00 – 04, siis on aeg 00
                    $tempdata[$key][$yd] = $data['celsius'];
                }
            }
        }
    }
    $html = "";
    // Info tabelisse
    foreach($tempdata as $key=> $md){
        $html.="<tr><td>".$key."</td>";
        foreach($yeardata as $yd){
            $ydata = isset($md[$yd]) ? $md[$yd] : '-';
            $html.="<td>".$ydata."</td>";
        }
        $html.="</tr>";
    }
     
    echo $html;
}