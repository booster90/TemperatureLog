<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TempPomiar
 *
 * @author booster
 */
class TempPomiar extends SQLite3{
    private $data = "";
    private $czas = "";
    private $temp = "";
    private $avg = "";
    private $avg_today = "";
   
    function __construct() {
        $this->open('temp.db');
        
        $sql = 'SELECT * FROM temp ORDER BY id DESC LIMIT 1';
        $sql_avg ='SELECT avg(temp) FROM temp;';
        $sql_avg_today ='SELECT avg(temp) FROM temp WHERE data=date("now");';
        
        $obj = $this->query($sql);
        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {      
              $this->data = $row['data'];
              $this->czas = $row['godz'];
              $this->temp = $row['temp'];
            }
        
        $this->avg = $this->querySingle($sql_avg);
        $this->avg_today = $this->querySingle($sql_avg_today);
        
        //$this->close();
    }
    
    function getData(){
        return $this->data;
    }
    
    function getGodz(){
        return $this->czas;
    }
    
    function getTemp(){
        return $this->temp;
    }
    
    function getAvg(){
        return $this->avg;
    }
    
    function getAvgToday(){
        return $this->avg_today;
    }
    
}