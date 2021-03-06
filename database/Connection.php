<?php
/**
 * Description of Connection
 *
 * @author afadinsro
 * @version 1.0
 */

require_once 'credentials.php';


class Connection {

    private $link;
    private $result;

    /**
     * Destructor function for the class
     * Closes the mysqli link and frees the result if any exists
     */
    function __destruct() {
        if($this->result) {
            mysqli_free_result($this->result);
        }
        if($this->link) {
            mysqli_close($this->link);
        }
    }
    
    /**
     * Connects to the database
     * @return boolean TRUE upon successful connection and FALSE if otherwise
     */
    function connect() {
        $connected = FALSE;

        $this->link = new mysqli(SERVER, USERNAME, PASSWORD, CPROJECT_DATABASE);
        //check for errors
        if (!mysqli_connect_errno()) {
            $connected = TRUE;
        }
        //return success
        return $connected;
    }

    /**
     * Executes a given SQL statement
     * This method makes use of prepared statements and 
     * binds the parameters dynamically.
     * @param string $query SQL statement to execute.
     * @param mixed $values The parameters to be bound to the prepared statement
     * @return boolean
     */
    function query(string $query, ...$values) {
        $success = FALSE;
        
        //check for a valid connection
        if ($this->connect()) {
            //prepare statement
            $prepStmt = mysqli_prepare($this->link, $query);
        }
        if ($prepStmt) {
            //no need to bind params if 
            if($values != NULL){
                $types = Connection::get_types($values);
                //bind the values dynamically
                mysqli_stmt_bind_param($prepStmt, $types, ...$values);
            }
            //execute prepared statement
            $success = mysqli_stmt_execute($prepStmt);
            //keep result in class property
            $this->result = mysqli_stmt_get_result($prepStmt);
            
        }
        return $success;
    }
    
    /**
     * 
     * @param string $query
     * @param mixed $values
     * @return boolean
     */
    function real_escape_query(string $query, ...$values) {
        $success = FALSE;
        $param_arr = NULL;
        
        if ($this->connect()) {
            //get an array of escaped strings
            $param_arr = $this->escape_params($values);
        
            if($values != NULL){
                //bind escaped strings to query
                $escaped_query = vsprintf($query, $param_arr);
            }
            $success = mysqli_query($this->link, $escaped_query);
        }
        return $success;
    }
    
    /**
     * 
     * @param array $param_arr
     * @return array
     */
    private function escape_params(Array $param_arr) {
        $escaped_param_array = [];
        foreach ($param_arr as $param) {
            if(is_int($param)){
                $escaped_param_array[] = (int)$param;
            } elseif (is_double($param)) {
                $escaped_param_array[] = (double)$param;
            } elseif (is_string($param)) {
                $escaped_param_array[] = mysqli_real_escape_string($this->link, $param);
            }
        }
        return $escaped_param_array;
    }
    
    
    /**
     * Gets the string representation of the data types 
     * of the values to bind dynamically to a prepared statement
     * @param Array $valueArray An array of values to insert into a database
     * @return reference The string representation of the data types of the values to insert
     */
    private static function get_types(Array $valueArray) {
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

    /**
     * Fetches the MySQL result
     * @return mysqli_result The result from query()
     */
    public function fetch() {
        return $this->result;
    }

    /**
     * Fetches an associative array of the SQL result
     * @return Array An associative array of the results from query()
     */
    public function fetch_assoc() {
        return mysqli_fetch_assoc($this->result);
    }
    
    public function get_num_rows() {
        
    }
}
