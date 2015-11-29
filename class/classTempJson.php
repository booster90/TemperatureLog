<?php
include "tempSQLite.class.php";
/**
 * 
 * jsonuje dane by ich uzyc pozniej w apce mobilnej..
 * 
 */
class TempJson {
    
    private $data;

    /**
     * konstruktor
     * 
     */
    function __construct() { 
        $db = new Temperature();
        $this->data = $db->getTodayData();   
    }
    
    /*
     * zwracamy jsona 
     */
    function getMobileTemperature(){
        
        echo json_encode($this->data);
    }
}