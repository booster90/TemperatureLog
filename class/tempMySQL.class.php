<?php
/*
 * 
 * klasa obslugi i parsowania danych z bazy mysql
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
        /*
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->close();*/
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

        $ret = $conn->query($sql);

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
        
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM sensor_2 ORDER BY id DESC LIMIT 1";
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $this->data = $row['data'];
                $this->czas = $row['godz'];
                $this->temp = $row['temp'];
                $this->date_db = $row["data_from_db"];
            }
        }
        $conn->close();
            return 'Ostatni pomiar wynosił: ' . $this->temp . ' &deg;C data: ' . $this->data . ' o godzinie ' . $this->czas . ' ';
    }

    /**
     * 
     * funkcja zwraca srednia temperatury
     * 
     * @return type string -> temperatura srednia
     */
    function getAvg() {
        
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = 'SELECT avg(temp) FROM sensor_2';
        $this->avg = $conn->query($sql);
        $conn->close();
        
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
