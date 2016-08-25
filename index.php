<?php
//DEBUGOWANIE !!!!!!!!!!!!
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

include "class/tempSQLite.class.php";
include "class/makeArrayJsChart.php";
include "class/pressureAir.class.php";

//nowy obiekt
$pressure = new Pressure('pressure.db');
$temp = new Temperature('temperature_sensor.db');

//podejscie obiektowe uzywamy metod z klasy ktora napisalem
$sql_dzis = "SELECT * FROM sensor_1 WHERE data=date('now') AND godz BETWEEN time('05:00:00') AND time('24:00:10');";
$sql_dzis_zewn = "SELECT * FROM sensor_2 WHERE data=date('now') AND godz BETWEEN time('05:00:00') AND time('24:00:10');";
$sql_dzis_piec = "SELECT * FROM sensor_3 WHERE data=date('now') AND godz BETWEEN time('05:00:00') AND time('24:00:10');";

//tworzymy dane pod wykres
$dzis = new makeArrayJsChart($temp->makeArraySurvey($sql_dzis));
$dzis_zewn = new makeArrayJsChart($temp->makeArraySurvey($sql_dzis_zewn));
$dzis_piec = new makeArrayJsChart($temp->makeArraySurvey($sql_dzis_piec));

//z wczoraj
$sql_wczoraj = "SELECT * FROM sensor_1 WHERE data=date('now','-1 day') AND godz BETWEEN time('05:00:00') AND time('24:00:10') OR data=date('now') AND godz<time('00:00:30');";
$sql_wczoraj_zewn = "SELECT * FROM sensor_2 WHERE data=date('now','-1 day') AND godz BETWEEN time('05:00:00') AND time('24:00:10') OR data=date('now') AND godz<time('00:00:30');";
$sql_wczoraj_piec = "SELECT * FROM sensor_3 WHERE data=date('now','-1 day') AND godz BETWEEN time('05:00:00') AND time('24:00:10') OR data=date('now') AND godz<time('00:00:30');";

$wczoraj = new makeArrayJsChart($temp->makeArraySurvey($sql_wczoraj));
$wczoraj_zewn = new makeArrayJsChart($temp->makeArraySurvey($sql_wczoraj_zewn));
$wczoraj_piec = new makeArrayJsChart($temp->makeArraySurvey($sql_wczoraj_piec));

//i przedwczoraj
$sql_przedWczoraj = "SELECT * FROM sensor_1 WHERE data=date('now','-2 day') AND godz BETWEEN time('05:00:00') AND time('24:00:10') OR data=date('now','-1 day') AND godz<time('00:00:30');";
$sql_przedWczoraj_zewn = "SELECT * FROM sensor_2 WHERE data=date('now','-2 day') AND godz BETWEEN time('05:00:00') AND time('24:00:10') OR data=date('now','-1 day') AND godz<time('00:00:30');";
$sql_przedWczoraj_piec = "SELECT * FROM sensor_3 WHERE data=date('now','-2 day') AND godz BETWEEN time('05:00:00') AND time('24:00:10') OR data=date('now','-1 day') AND godz<time('00:00:30');";

$przedwczoraj = new makeArrayJsChart($temp->makeArraySurvey($sql_przedWczoraj));
$przedwczoraj_zewn = new makeArrayJsChart($temp->makeArraySurvey($sql_przedWczoraj_zewn));
$przedwczoraj_piec = new makeArrayJsChart($temp->makeArraySurvey($sql_przedWczoraj_piec));
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="" content="">
        <meta name="krystianm" content="pomiar temperatury raspberry pi">
        <link rel="icon" href="favicon.ico">

        <title>Pi Pomiar</title>

        <!-- Bootstrap core CSS -->
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">

        <!--font awesome icons -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/pi_pomiar.css" rel="stylesheet">

        <!-- lib chart-->
        <script src="/libs/Chart.js/Chart.js"></script>

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">PI Pomiar</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="https://malina/">Home</a></li>
                        <li><a href="https://malina.dev/">Pomiar dev</a></li>
                        <li><a href="https://openwrt/bandwidthd/">Pasmo</a></li>
                        <li ><a href="http://gitlab.malina/">Repo</a></li>
                        <li><a href="https://phpmyadmin.malina/">PHPMyAdmin</a></li>
                        <li><a href="https://dev/phpLiteAdmin/public/">SQLiteAdmin</a></li>

                        <!--krystianm.pl -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">krystianm.pl<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://krystianm.pl/">krystianm.pl</a></li>
                                <li><a href="http://krystianm.pl.malina">krystianm.pl.malina(dev)</a></li>
                            </ul>
                        </li>

                        <!--pierdolki -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pogoda<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="https://www.google.pl/#q=pogoda+ostrow+wlkp">Prognoza pogody</a></li>
                                <li><a href="http://new.meteo.pl/um/php/meteorogram_id_um.php?ntype=0u&id=2569">Prognoza pogody(meteo.pl)</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="http://ozdobne.pl/">ozdobne.pl(prod)</a></li>
                                <li><a href="http://ozdobne.pl.malina/">ozdobne.pl(dev)</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="starter-template">
            <div id="timer">00:00:00</div>
            <h1>Temperatura i ciśnienie</h1>
            <hr class="featurette-divider">

            <p class="lead"><?php echo ' ' . $pressure->getLastSurvey(); ?></p>
            <p class="lead"><i class="fa fa-home"></i><?php echo ' ' . $temp->getLastSurvey_inside(); ?></p>
            <p class="lead"><?php echo $temp->getLastSurvey_heater(); ?></p>
            <p class="lead"><?php echo $temp->getLastSurvey_outside(); ?></p>

            <h1>Dziś</h1>
            <p class="lead"><canvas id="wykresDzis" width="600" height="100"></canvas></p>

            <h1>Wczoraj</h1>
            <div class="center">
                <canvas id="wykresWczoraj" width="600" height="100"></canvas>
            </div>

            <h1>Przedwczoraj</h1>
            <div class="center">
                <canvas id="wykresPrzedWczoraj" width="600" height="100"></canvas>
            </div>

            <hr>
        </div>

    </div><!-- /.container -->
    <!-- Bootstrap core JavaScript
   ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- skrypt JS-->
    <script type="text/javascript">
        //kolejne wykresy w chart.js
        var lineChartData = {
            labels: ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'],
            datasets: [
                {
                    label: "Pomiar czujnik nr 1 pokój",
                    fillColor: "rgba(38, 255, 17, 0.4)",
                    strokeColor: "rgba(38, 255, 17,1)",
                    pointColor: "rgba(38, 255, 17,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $dzis->get(); ?>
                },
                {
                    label: "Pomiar czujnik nr 2 układ CO",
                    fillColor: "rgba(244, 15, 10, 0.2)",
                    strokeColor: "rgba(244, 15, 10,1)",
                    pointColor: "rgba(244, 15, 10,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: <?php echo $dzis_piec->get(); ?>
                },
                {
                    label: "Pomiar czujnik nr 3 zewnatrz",
                    fillColor: " rgba(215, 44, 245, 0.4)",
                    strokeColor: "rgba(215, 44, 245, 1)",
                    pointColor: "rgba(215, 44, 245, 1);",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: <?php echo $dzis_zewn->get(); ?>
                }
            ]
        }

        var lineChartData_wczoraj = {
            labels: ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'],
            datasets: [
                {
                    label: "Pomiar czujnik nr 1 pokój",
                    fillColor: "rgba(38, 255, 17, 0.4)",
                    strokeColor: "rgba(38, 255, 17,1)",
                    pointColor: "rgba(38, 255, 17,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $wczoraj->get(); ?>
                },
                {
                    label: "Pomiar czujnik nr 2 układ CO",
                    fillColor: "rgba(244, 15, 10, 0.2)",
                    strokeColor: "rgba(244, 15, 10,1)",
                    pointColor: "rgba(244, 15, 10,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: <?php echo $wczoraj_piec->get(); ?>
                },
                {
                    label: "Pomiar czujnik nr 3 zewnatrz",
                    fillColor: " rgba(215, 44, 245, 0.4)",
                    strokeColor: "rgba(215, 44, 245, 1)",
                    pointColor: "rgba(215, 44, 245, 1);",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: <?php echo $wczoraj_zewn->get(); ?>
                }
            ]
        }

        var lineChartData_przed = {
            labels: ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'],
            datasets: [
                {
                    label: "Pomiar czujnik nr 1 pokój",
                    fillColor: "rgba(38, 255, 17, 0.4)",
                    strokeColor: "rgba(38, 255, 17,1)",
                    pointColor: "rgba(38, 255, 17,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $przedwczoraj->get(); ?>
                },
                {
                    label: "Pomiar czujnik nr 2 układ CO",
                    fillColor: "rgba(244, 15, 10, 0.2)",
                    strokeColor: "rgba(244, 15, 10,1)",
                    pointColor: "rgba(244, 15, 10,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: <?php echo $przedwczoraj_piec->get(); ?>
                },
                {
                    label: "Pomiar czujnik nr 3 zewnatrz",
                    fillColor: " rgba(215, 44, 245, 0.4)",
                    strokeColor: "rgba(215, 44, 245, 1)",
                    pointColor: "rgba(215, 44, 245, 1);",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: <?php echo $przedwczoraj_zewn->get(); ?>
                }
            ]
        }

        window.onload = function () {
            var wykres_dzis = document.getElementById("wykresDzis").getContext("2d");
            var wykres_wczoraj = document.getElementById("wykresWczoraj").getContext("2d");
            var wykres_przed = document.getElementById("wykresPrzedWczoraj").getContext("2d");

            window.myLine = new Chart(wykres_dzis).Line(lineChartData, {
                responsive: true
            });
            window.myLine = new Chart(wykres_wczoraj).Line(lineChartData_wczoraj, {
                responsive: true
            });
            window.myLine = new Chart(wykres_przed).Line(lineChartData_przed, {
                responsive: true
            });

        }
    </script>
    <!-- simple timer for div id=timer -->
    <script src="js/timer.js"></script>
</body>
</html>