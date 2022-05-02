<?php 
    require "settings.php";
    include_once 'templates/header.php'
?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  
  <!-- Andmete hankimine andmebaasist -->
  <?php
  try {
        $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
        $connection->exec("SET NAMES utf8");
        $sql = 'SELECT added from ilm_ds18_out_east ORDER BY added DESC LIMIT 1';
        $statement = $connection->prepare($sql); // valmistab sql-i ette
        $statement->execute(); // Käivita SQL lause koos muutujatega
        $result = $statement->fetch();
        $row = ($result);
        //echo $row['added']; // Print a single column data
        $day = date('d', strtotime($row['added']));
        $year = date('Y', strtotime($row['added']));
        $month = date('m', strtotime($row['added']));
        $date = date("d.m.Y", strtotime($row['added']));
            $sqlEast = 'SELECT celsius from ilm_ds18_out_east where added = '.$date;
            $statement = $connection->prepare($sql); // valmistab sql-i ette
            $statement->execute(); // Käivita SQL lause koos muutujatega
            $result = $statement->fetch();
            $row = ($result);
        
      } catch (PDOException $error) {
        echo "SQL: <strong>" . $sql . "</strong><br />" . $error->getMessage();
      }
      
     ?></p>

<!-- Veebisait -->
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}
</style>
</head>
<body>

<div class="container text-body text-center">
    <h1 id="index-text" class="font-weight-bold" style="margin-top: 15px; margin-bottom: 25px">Temperatuurid idas <br><span id="selected_date"></span>
    </h1>
    <div class="row">
    <div class="column">
    <!-- Kalender -->
    <div id="datepicker" class ="col-md-1 col-md-offset-1"></div>
    </div>
    <!-- Tabel -->
    <div class="column">
    <table id="weatherData" class="table is-hoverable is-bordered is-fullwidth col-md-8 col-md-offset-8">
        <thead class="has-text-centered">
            <tr>
                <th>Kellaaeg</th>
                <th>2022</th>
                <th>2021</th>
                <th>2020</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
    </div>
</div>  
</body>
</html>
<?php 
    include_once 'templates/footer.php'
?>


<script>
   // Kuupäeva valimine kalendris
  $( function() {
    $( "#datepicker" ).datepicker({onSelect: function(dateText) {
        $("#selected_date").html(this.value);
        $.ajax({
            url:"ajaxE.php",
            type:"post",
            data:{sel_date: this.value},
            success: function(html){
                $("#weatherData tbody").html(html);
            }
        })
    },dateFormat:'dd.mm.yy', minDate: new Date(2019, 12, 1), maxDate: new Date(<?php echo $year ?>, <?php echo $month -1 ?>, <?php echo $day ?>)}); // kuupäevade vahemik, mida saab valida
  } );
</script>
