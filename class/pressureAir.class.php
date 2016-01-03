<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pressure extends SQLite3 {

    //nasze dane
    private $data = "";
    private $cisnienie = "";
    
    private $avg = "";
    private $avg_today = "";

    /**
     * konstruktor ze sciezka do bazy..
     * 
     * todo:
     *      *mozna dodac obsluge bledow,
     *      *..   
     */
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
     * Wyswietla ostatni pomiar.
     * 
     * @return type string
     */
    function getLastSurvey() {
        
        $sql = 'SELECT * FROM barometric_sensor ORDER BY id DESC LIMIT 1';
        
        $obj = $this->query($sql);
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
            
            $this->data = $row['data_time'];
            $this->cisnienie = $row['pressure'];
        }
        return 'Ciśnieniu ' . $this->cisnienie . ' hPa ( '.$this->data.' )';
    }
}