<?php
include_once 'templates/header.php';
require 'settings.php';

// YYYY-MM-DD HH:MM:SS >  DD.MM.YYYY HH:MM:SS
	function dbDateToEstDateClock($date) {
		return date('d.m.Y H:i:s', strtotime($date));
	}
?>
<!-- Hiliseim mõõdetud temperatuur-->
<html>
<head>
  <div class="container text-body text-center padding-bottom: 0px">
    <h1 id="index-text" class="font-weight-bold" style="margin-top: 15px">Tere tulemast!
    </h1>
    <p>Temperatuuri hiliseim mõõtmisaeg:
      <?php
      //Andmebaasiühendus, kirjed, mis näidatakse lehel
      try {
        $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
        $connection->exec("SET NAMES utf8");
        $sql = "SELECT * FROM 
  (
      SELECT * FROM ilm_ds18_out_east
      UNION ALL
      SELECT * FROM ilm_ds18_out_west
  ) 
  AS ALL_RECORDS
  ORDER BY added DESC LIMIT 1"; // võetakse viimane kirje 
        $statement = $connection->prepare($sql); // valmistab sql-i ette
        $statement->execute(); // Käivita SQL lause koos muutujatega
        $result = $statement->fetch();
        $row = ($result);
        //echo $row['added']; // Print a single column data
        echo $row['added'] = date('d.m.Y H:m:s', strtotime($row['added']));
      } catch (PDOException $error) {
        echo "SQL: <strong>" . $sql . "</strong><br />" . $error->getMessage();
      } ?></p>
      <!--<p>Temperatuur: <?php echo number_format((float)$row['celsius'], 2, '.', '');  ?>℃</p>    -->
  </div>

  <?php 
  // Läänes
  $sqlW = "SELECT * FROM ilm_ds18_out_west
  ORDER BY added DESC LIMIT 1"; // võetakse viimane kirje idast
  $statementW = $connection->prepare($sqlW); // valmistab sql-i ette
  $statementW->execute(); // Käivita SQL lause koos muutujatega
  $resultW = $statementW->fetch();
  $rowW = ($resultW);
  // Idas
  $sqlE = "SELECT * FROM ilm_ds18_out_east
  ORDER BY added DESC LIMIT 1"; // võetakse viimane kirje idast
  $statementE = $connection->prepare($sqlE); // valmistab sql-i ette
  $statementE->execute(); // Käivita SQL lause koos muutujatega
  $resultE = $statementE->fetch();
  $rowE = ($resultE);
  ?>
  <!--Visualisatsioon-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['gauge']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Läänes', <?php echo $rowW['celsius']?>], 
          ['Idas', <?php echo $rowE['celsius']?>],
        ]);

        const major = [-30, -20, -10, 0, 10, 20, 30, 40, 50]; 

        var options = {
          width: 500,
          height: 220,
          redFrom: 35,
          redTo: 50,
          yellowFrom: 25,
          yellowTo: 35,
          minorTicks: 10,
          majorTicks: major,
          min: -30,
          max: 50
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

       
      }
    </script>
</head>
<?php
  // Hetke andmed
$response = CallAPI("GET", "https://api.openweathermap.org/data/2.5/weather?lat=58.924888&lon=24.868806&appid=ff6bb9d23ceac641e4f65a6e9e2ad531&units=metric", null);
//echo $response;
$response = json_decode($response);
?>
<body>
  <div id="chart_div" style="width: 440px; height: 220px; margin: auto; padding-top: 0px"></div>

  <div class="container text-body text-center" style="padding-top: 30px">
    <p><?php echo date("H:i:s",$response->sys->sunrise) ?> <i class="fas fa-sun" style="font-size: 25px; color: yellow;">   </i>
    <?php echo date("H:i:s",$response->sys->sunset) ?> <i class="fas fa-moon" style="font-size: 25px; color: darkBlue;"></i>
    </p>
  </div>
</body>

</html>

<?php
include_once 'templates/footer.php'
?>