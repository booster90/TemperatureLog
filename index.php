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
        //dla sqlite
        include "class/tempSQLite.class.php";
        include "class/makeArrayJsChart.php";
        
        $temp = new Temperature();
        
        //podejscie obiektowe uzywamy metod z klasy ktora napisalem
        $sql_dzis = "SELECT * FROM sensor_1 WHERE data=date('now') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $sql_dzis_piec = "SELECT * FROM sensor_2 WHERE data=date('now') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $dzis = new makeArrayJsChart( $temp->makeArraySurvey($sql_dzis) );
        $dzis_piec = new makeArrayJsChart($temp->makeArraySurvey($sql_dzis_piec));
        
        //z wczoraj
        $sql_wczoraj = "SELECT * FROM sensor_1 WHERE data=date('now','-1 day') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $sql_wczoraj_piec = "SELECT * FROM sensor_2 WHERE data=date('now','-1 day') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";        
        $wczoraj = new makeArrayJsChart( $temp->makeArraySurvey($sql_wczoraj) );
        $wczoraj_piec = new makeArrayJsChart( $temp->makeArraySurvey($sql_wczoraj_piec) );

        //i przedwczoraj
        $sql_przedWczoraj = "SELECT * FROM sensor_1 WHERE data=date('now','-2 day') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $sql_przedWczoraj_piec = "SELECT * FROM sensor_2 WHERE data=date('now','-2 day') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        
        $przedwczoraj = new makeArrayJsChart( $temp->makeArraySurvey($sql_przedWczoraj) );
        $przedwczoraj_piec = new makeArrayJsChart( $temp->makeArraySurvey($sql_przedWczoraj_piec) );
        ?>
        
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
                        fillColor: "rgba(244, 15, 10, 0.1)",
                        strokeColor: "rgba(244, 15, 10,1)",
                        pointColor: "rgba(244, 15, 10,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: <?php echo $dzis_piec->get(); ?>
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
                        data: <?php echo $wczoraj->get(); ?>
                      },
                    
                    {
                        label: "Pomiar czujnik nr 2 raspberry",
                        fillColor: "rgba(110,110,110,0.2)",
                        strokeColor: "rgba(110,110,110,1)",
                        pointColor: "rgba(110,110,110,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(110,110,110,1)",
                        data: <?php echo $wczoraj_piec->get(); ?>
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
                        data: <?php echo $przedwczoraj->get(); ?>
                    },
                    
                    {
                        label: "Pomiar czujnik nr 2 raspberry",
                        fillColor: "rgba(110,110,110,0.2)",
                        strokeColor: "rgba(110,110,110,1)",
                        pointColor: "rgba(110,110,110,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(110,110,110,1)",
                        data: <?php echo $przedwczoraj_piec->get(); ?>
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
        <p class='center'><?php echo $temp->getLastSurvey(); echo "przy średniej temperaturze dziś ".substr($temp->getAvgToday(),0,5)." &deg;C oraz globalnej ".substr($temp->getAvg(),0,5)." &deg;C</p>"; ?>
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
            <?php include "../include/footer.php";?>
        </footer>
    </body>
</html>
