<?php

//include "tempSQLite.class.php";



class classTempJson {
    
    private $data;

    /**
     * konstruktor
     * 
     */
    function __construct() { 
        $db = new Temperature();
        $this->data = $db->getTodayData();
        
        //echo json_encode($data);
        
    }
    
    /*
     * zwracamy jsona 
     */
    function getMobileTemperature(){
        return json_encode($this->data);
    }
}