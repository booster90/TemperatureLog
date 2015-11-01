<!DOCTYPE html>
<html lang="pl"> 
    <head>
        <title>Witaj na mojej domowej stronie</title>

        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="booster" >
        <!-- określenie szerokości ekranu i skali -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="Stylesheet" href="css/styl.css" type="text/css" />

        <!-- lib chart-->
        <script src="/libs/Chart.js/Chart.js"></script>

        <?php
        include "classTempDB.php";
        include "classTempPomiar.php";
        include "makeArrayJsChart.php";
        
        $ostatniPomiar = new TempPomiar();

        // pobieramy dane z obiektu ostatniPomiar
        $d = $ostatniPomiar->getData();
        $c = $ostatniPomiar->getGodz();
        $t = $ostatniPomiar->getTemp();
        $avg = $ostatniPomiar->getAvg();
        $todayAvg = $ostatniPomiar->getAvgToday();
        
        $obiektBazyDanych = new TempDB();
        if (!$obiektBazyDanych) {
            echo $obiektBazyDanych->lastErrorMsg();
        } else {
            //udalo sie otworzyć baze danych.
        }

//$sql = 'SELECT * FROM temp WHERE godz > 6 & godz < 24 & data='.date("Y-m-d").' ORDER BY id DESC LIMIT 24;';
//tutaj aktualne bez pierdzielenia sie w zapytaniu
        $sql = "SELECT * FROM temp WHERE data=date('now') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $ret = $obiektBazyDanych->query($sql);
        
        
        $today=array();
        
        //if date_now!=row['date']; to nie rysuj
        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
               
            $today[] = array( substr($row['godz'], 0, 2) => $row['temp'] );
            //array_push( $araj, $temp );
        }
        
        $test = new makeArrayJsChart($today);
    
        //i wczoraj
        $sql_wczoraj = "SELECT * FROM temp WHERE data=date('now','-1 day') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $ret2 = $obiektBazyDanych->query($sql_wczoraj);
        
        $yesterday = array();
        
        //if date_now!=row['date']; to nie rysuj
        while ($row2 = $ret2->fetchArray(SQLITE3_ASSOC)) {
            $yesterday[] = array( substr($row2['godz'], 0, 2) => $row2['temp'] );
        }
        
        $test2 = new makeArrayJsChart($yesterday);

        //i wczoraj
        $sql_przedWczoraj = "SELECT * FROM temp WHERE data=date('now','-2 day') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $ret3 = $obiektBazyDanych->query($sql_przedWczoraj);
        
        $twoDayAgo = array();
        
        while ($row3 = $ret3->fetchArray(SQLITE3_ASSOC)) {
            $twoDayAgo[] = array( substr($row3['godz'], 0, 2) => $row3['temp'] );           
        }
        $test3 = new makeArrayJsChart($twoDayAgo);
        
        $obiektBazyDanych->close();
        
        ?>

        <!-- skrypt JS-->

        <script type="text/javascript">
            
            //kolejne wykresy w chart.js
            var lineChartData = {
                labels: ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'],
                datasets: [
                    {
                        label: "Pomiar czujnik nr 1 raspberry",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: <?php echo $test->get(); ?>
                    }
                ]
            }
                            
            var lineChartData_wczoraj = {
                labels: ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'],
                datasets: [
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: <?php echo $test2->get(); ?>
                      }
                ]
            }
            
            var lineChartData_przed = {
                labels: ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'],
                datasets: [
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(181,217,205,0.2)",
                        strokeColor: "rgba(181,217,205,1)",
                        pointColor: "rgba(1581,217,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: <?php echo $test3->get(); ?>
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

    </head>
    <body>		
        <header>
            Witaj moim domowym serwerze
        </header>

        <nav> 
            <?php include "../include/nav.php" ?>
        </nav>

        <div id="zawartosc"></div>
        <?php echo "<p class='center'>Ostatni pomiar wykonano: " . $d . " o godzinie " . $c . " i wynosił " . $t . " C  przy średniej temperaturze dziś ".substr($todayAvg,0,5)." C oraz globalnej".substr($avg,0,5)." C</p>"; ?>
        <div class="center">
            <canvas id="wykresDzis" width="600" height="200"></canvas>
        </div>
        
        <?php echo "<p class='center'>Pomiar wczoraj</p>"; ?>
        <div class="center">
            <canvas id="wykresWczoraj" width="600" height="200"></canvas>
        </div>
        
        <?php echo "<p class='center'>Pomiar z przed wczoraj</p>"; ?>
        <div class="center">
            <canvas id="wykresPrzedWczoraj" width="600" height="200"></canvas>
        </div>
        <footer>
            <?php include "../include/footer.php"; ?>
        </footer>
    </body>
</html>
