<?php

/*
 * 
 * klasa obslugi i parsowania danych z bazy sqlite
 * 
 */

class Temperature extends SQLite3 {

    //nasze dane
    private $data = "";
    private $czas = "";
    private $temp = "";
    private $avg = "";
    private $avg_today = "";

    /**
     * konstruktor ze sciezka do bazy..
     * 
     * todo:
     *      *mozna dodac obsluge bledow,
     *      *..   
     */
    //
    function __construct($path) {
        $this->open($path);
    }

    /**
     * 
     * Przygotuj pomiar z dzis jako tablice..
     * 
     * @return type array
     */
    function makeArraySurvey($sql) {
        //$sql = "SELECT * FROM temp WHERE data=date('now') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        //SATANIZE THIS 

        $ret = $this->query($sql);
        $today = array();

        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {

            $today[] = array(substr($row['godz'], 0, 2) => $row['temp']);
            //array_push( $araj, $temp );
        }

        return $today;
    }

    /**
     * 
     * Wyswietla ostatni pomiar temperatury w domu.
     * 
     * @return type string
     */
    function getLastSurvey() {
        $sql = 'SELECT * FROM sensor_1 ORDER BY id DESC LIMIT 1';
        
        $obj = $this->query($sql);
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
            $this->data = $row['data'];
            $this->czas = $row['godz'];
            $this->temp = $row['temp'];
        }
        return 'Temperatura: ' . $this->temp . ' &deg;C ( ' . $this->data . ' ' . $this->czas . ' )';
    }
    
    /**
     * 
     * Wyswietla ostatni pomiar temperatury w domu.
     * 
     * @return type string
     */
    function getLastSurvey_inside() {
        $sql = 'SELECT * FROM sensor_1 ORDER BY id DESC LIMIT 1';
        
        $obj = $this->query($sql);
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
            $this->data = $row['data'];
            $this->czas = $row['godz'];
            $this->temp = $row['temp'];
        }
        return 'Temperatura: ' . $this->temp . ' &deg;C ( ' . $this->data . ' ' . $this->czas . ' )';
    }
    
    /**
     * 
     * Wyswietla ostatni pomiar z CO.
     * 
     * @return type string
     */
    function getLastSurvey_heater() {
        $sql = 'SELECT * FROM sensor_2 ORDER BY id DESC LIMIT 1';
        
        $obj = $this->query($sql);
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
            $this->data = $row['data'];
            $this->czas = $row['godz'];
            $this->temp = $row['temp'];
        }
        return 'Temperatura: ' . $this->temp . ' &deg;C ( ' . $this->data . ' ' . $this->czas . ' )';
    }
    
    /**
     * 
     * Wyswietla ostatni pomiar z zewnatrz.
     * 
     * @return type string
     */
    function getLastSurvey_outside() {
        $sql = 'SELECT * FROM sensor_3 ORDER BY id DESC LIMIT 1';
        
        $obj = $this->query($sql);
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
            $this->data = $row['data'];
            $this->czas = $row['godz'];
            $this->temp = $row['temp'];
        }
        return 'Temperatura: ' . $this->temp . ' &deg;C ( ' . $this->data . ' ' . $this->czas . ' )';
    }
    
     /**
     * 
     * pobieramy dzisiejsze dane dla potrzeb apki mobilnej 
     * format to:
     * array(
     *      godz => 21:00:01,
     *      data => 2015-11-13,
     *      temp => 21.02
     * )
     * array(
     *      ...                 
     * 
     * @return type array
     */
    function getTodayData() {   
        $sql = "SELECT * FROM sensor_1 WHERE data=date('now') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        $todayDataArr=Array();
        
        $obj = $this->query($sql);
        
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
            $temp = array(
                "data" => $row['data'],
                "godzina" => $row['godz'],
                "temperatura" => $row['temp']
            );
            
            //dodaj do tablicy 
            $todayDataArr[] = $temp;
        }
        return $todayDataArr;
    }

    /**
     * 
     * funkcja zwraca srednia temperatury
     * 
     * @return type string -> temperatura srednia
     */
    function getAvg() {
        $this->avg = $this->querySingle('SELECT avg(temp) FROM sensor_1;');
        return $this->avg;
    }

    /**
     * 
     * funkcja zwraca średnia temperature z obecnego dnia
     * 
     * @return type string
     */
    function getAvgToday() {
        $this->avg_today = $this->querySingle('SELECT avg(temp) FROM sensor_1 WHERE data=date("now");');
        return $this->avg_today;
    }

    //jakies stare funkcje gettery..
    function getData() {
        return $this->data;
    }

    function getGodz() {
        return $this->czas;
    }

    function getTemp() {
        return $this->temp;
    }

    //$this->close();
}
