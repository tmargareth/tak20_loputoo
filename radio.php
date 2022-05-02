<?php
include_once 'templates/header.php'
?>

<div class="container text-body text-center">
    <h1 id="index-text" class="font-weight-bold" style="margin-top: 15px; margin-bottom: 15px">Raadiod
    </h1>

    <body>
        <div>
            <a title="Vikerraadio"><img src="vikerraadio.jpg"></a>
            <audio controls title="Vikerraadio" style="padding-top: 25px;">
                <source src="http://icecast.err.ee/vikerraadio.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div>
            <a title="Power Hit Radio"><img src="power.png"></a>
            <audio controls title="Power Hit Radio" style="padding-top: 25px;">
                <source src="https://ice.leviracloud.eu/phr96-aac" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div>
            <a title="StarFM"><img src="star.jpg"></a>
            <audio controls title="StarFM" style="padding-top: 25px;">
                <source src="https://ice.leviracloud.eu/star96-aac" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </body>
</div>

<?php
include_once 'templates/footer.php'
?>