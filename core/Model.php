<?php

// model to connect the database
class Model{
    protected $db;
    
    public function __construct(){
        
        // connect to the directory file which includes the database configuration
        $config = require __DIR__ . '/../config/db_config.php' ;
        
        $this -> db = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database'],
        );

        // check whether any error while connectiong database
        if ($this -> db ->connect_error){
            echo "Database Connection failed : " . $this -> db -> connect_error; 
        }
    } 
}

?>