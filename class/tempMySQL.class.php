<?php

/*
 * 
 * klasa obslugi i parsowania danych z bazy sqlite
 */

class TempMySQL extends mysqli {
    
    //dane polaczenia 
    private $host = "localhost";
    private $user = 'root';
    private $password = 'boczek';
    private $database = 'temperature_ds1820';
    
    //nasze dane
    private $data = "";
    private $czas = "";
    private $temp = "";
    private $avg = "";
    private $avg_today = "";

    //konstruktor ze sciezka do bazy..
    function __construct() {
        $link = mysql_connect( $this->host, $this->user, $this->password) or die('Could not connect to server.' );
        mysql_select_db($this->database, $link) or die('Could not select database.');
        
    }
    
    /**
     * 
     * Przygotuj pomiar z dzis jako tablice..
     * 
     * @return type array
     */
    function makeArraySurvey($sql) {
        //$sql = "SELECT * FROM temp WHERE data=date('now') AND godz BETWEEN time('06:00:00') AND time('24:00:10');";
        //SATANIZE THIS KURWA
        
        $ret = $this->query($sql);

        $today = array();

        while ($row = $ret->fetchArray(MYSQLI_ASSOC)) {

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
        while ($row = $obj->fetchArray(MYSQLI_ASSOC)) {
            $this->data = $row['data'];
            $this->czas = $row['godz'];
            $this->temp = $row['temp'];
        }
        return 'Ostatni pomiar wynosił: ' . $this->temp . ' &deg;C data: ' . $this->data . ' o godzinie ' . $this->czas . ' ';
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
