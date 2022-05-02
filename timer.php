<?php
include_once 'templates/header.php'
?>
<div class="container text-body text-center">
    <h1 id="index-text" class="font-weight-bold" style="margin-top: 15px; margin-bottom: 15px">Taimer
    </h1>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

    <!-- Veebisait -->
    <div class="well">
        <time></time>

        <div class="button-group">
            <button type="button" onclick="timer.pause()">Paus</button>
            <button type="button" onclick="counttime()">Käivita</button>
            <button type="button" onclick="timer.stop()">Stopp</button>
        </div>

        <div class="form-group">
            <h3>Vali aeg</h3>
            <select id="time-type">
                <!--<option value="second">Seconds</option>-->
                <option value="minute">Minutid</option>
                <!--<option value="hour">Hour</option>-->
            </select>
            <!--<input type="number" id="time-field" placeholder="00">      -->
            <select id="time-field" placeholder="00">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
                <option value="60">60</option>
            </select>
            <br><button type="button" onclick="setTime()">Määra</button>
        </div>

        <!-- Heli valimine -->  
        <div class="form-group">
            <h3>Vali heli</h3>
            <input type="radio" name="answer" id="alarm" value="Alarm" src="alarm.mp3">
            <label for="alarm">Alarm</label>
            <input type="radio" name="answer" id="clock" value="Clock" checked="checked" src="clock.mp3">
            <label for="clock">Kell</label>
            <input type="radio" name="answer" id="police" value="Police"  src="police.mp3">
            <label for="police">Politsei</label>
        </div>
    </div>

    <!-- Include timer.js -->    
    <script src="dist/js/timers.js"></script>

    <!-- Initialize timer.js -->
    <script>
        let timer = new Timer({
            el: 'time',
            time: {
                second: 0,
                minute: 0,
                hour: 0,
            },
        });

        // Aja määramine
        function setTime() {
            var time = document.querySelector('#time-type').value;
            var value = document.querySelector('#time-field').value;
            timer.set(time, value);
        }
        // Alarm
        function counttime(){
            timer.resume();
            
        }
        
       
    </script>

</body>
</html>
</div>

<?php
include_once 'templates/footer.php'
?>