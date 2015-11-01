<?php

include "classTempDB.php";

class classTempJson extends SQLite3 {

    private $arr_json = array();

    function __construct() {
        $this->open('temp.db');

        $sql = 'SELECT * FROM temp ORDER BY id DESC LIMIT 10';
        $obj = $this->query($sql);

        while ($row = $obj->fetchArray(SQLITE3_ASSOC)) {
              $temp=array(
                    "data"=>$row['data'],
                    "godzina"=>$row['godz'],
                    "temperatura"=>$row['temp']
                );
              //dodaj do tablicy 
              $arr_json[]=$temp;
        }
        $this->close(); 
        //$json_temperatura = 
          echo json_encode($arr_json);
        //var_dump($json_temperatura);
    }
}