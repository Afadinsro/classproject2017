<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'credentials.php';

/**
 * Description of Connection
 *
 * @author afadinsro
 */
class Connection {
    //properties
    private $connection;
    private $result;


    //methods
    
    /**
     * Connects to a specified database
     * @param string $database Database to connect to
     * @return boolean TRUE upon successful connection and FALSE if otherwise
     */
    function connect($database) {
        $connected = FALSE;
        switch ($database) {
            case 'class':
                $this->connection = new mysqli(SERVER, USERNAME, PASSWORD, CLASS_DATABASE);
                break;
            case 'lab':
                $this->connection = new mysqli(SERVER, USERNAME, PASSWORD, LAB_DATABASE);
                break;
            case 'cproject':
                $this->connection = new mysqli(SERVER, USERNAME, PASSWORD, CPROJECT_DATABASE);
                break;
        }
        
        //print error message if there is an error
        if (!mysqli_connect_errno()) {
            $connected = TRUE;
        }
        //return success
        return $connected;
    }
    
    private function connected() {
        $connected = FALSE;
        if($this->connection){
            $connected = TRUE;
        }
        return $connected;
    }
            
    function query($SQLquery, $types, $valueArray) {
        $success = FALSE;
        //check for a valid connection
        if(!$this->connected()){
            return $success;
        }
        
    }
    
    /**
    * Gets a string representation of the data types of the values to insert
    * @param type $valueArray An array of values to insert into a database
    * @return string A string representation of the data types of the values to insert
    */
   function getTypes($valueArray) {
       $typeString = '';
       //get type for each element of array
       foreach ($valueArray as $value) {
           if (is_double($value)) {
               $typeString .= 'd';
           } else if (is_int($value)) {
               $typeString .= 'i';
           } else if (is_string($value)) {
               $typeString .= 's';
           }
       }
       return $typeString;
   }
    
}

$test = new Connection();
var_dump($test->connect('cproject'));