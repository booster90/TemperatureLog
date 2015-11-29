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
    function __construct() {
        $this->open('temp_test.db');
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
     * Wyswietla ostatni pomiar.
     * 
     * @return type string
     */
    function getLastSurvey() {
        $sql = 'SELECT * FROM temp ORDER BY id DESC LIMIT 1';
        
        $obj = $this->query($sql);
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
            $this->data = $row['data'];
            $this->czas = $row['godz'];
            $this->temp = $row['temp'];
        }
        return 'Ostatni pomiar wynosił: ' . $this->temp . ' &deg;C data: ' . $this->data . ' o godzinie ' . $this->czas . ' ';
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
        $sql = "SELECT * FROM temp WHERE data=date('now') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
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
        $this->avg = $this->querySingle('SELECT avg(temp) FROM temp;');
        return $this->avg;
    }

    /**
     * 
     * funkcja zwraca średnia temperature z obecnego dnia
     * 
     * @return type string
     */
    function getAvgToday() {
        $this->avg_today = $this->querySingle('SELECT avg(temp) FROM temp WHERE data=date("now");');
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
