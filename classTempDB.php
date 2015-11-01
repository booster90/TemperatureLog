<?php
/**
 * Description of ClassTempDB
 * Klasa tworzy obiekty bazy danych temp.db
 * @author booster
 */
class TempDB extends SQLite3 {
    
    function __construct() {
        $this->open('../../temp.db');
    }
}
