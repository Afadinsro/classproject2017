<?php

/* ----------------------DATABASE METHODS--------------------------------
  ---------------------------------------------------------------------- */

//constants for database connection
define('USERNAME', 'root');
define('PASSWORD', '');
define('SERVER', 'localhost');
define('CLASS_DATABASE', 'webtechclass');
define('LAB_DATABASE', 'webtechclass');
define('CPROJECT_DATABASE', 'classproject2017');

/**
 * Creates a database connection and returns it.
 * @param type $database Database to connect to
 * @return \mysqli A database connection
 */
function connectToDB($database) {
    //create connection
    switch ($database) {
        case 'class':
            $con = new mysqli(SERVER, USERNAME, PASSWORD, CLASS_DATABASE);
            break;
        case 'lab':
            $con = new mysqli(SERVER, USERNAME, PASSWORD, LAB_DATABASE);
            break;
        case 'cproject':
            $con = new mysqli(SERVER, USERNAME, PASSWORD, CPROJECT_DATABASE);
        default:
            break;
    }
    //print error message if there is an error
    if (mysqli_connect_errno()) {
        die('Connection failed: ' . mysqli_connect_error());
    }
    /* else{
      echo "connection successful";
      } */

    return $con;
}

/**
 * Checks if a connection to a database exists
 * @param type $dbCon A database connection
 * @return boolean True if connection exists, and false if otherwise
 */
function connected($dbCon) {
    if ($dbCon) {
        return true;
    } else {
        return false;
    }
}

/**
 * Insert data into a database
 * @param type $valueArray An array of values to insert
 * @param type $table The able name in the database
 * @param type $columnArray An array of columns to insert values
 * @param type $types A string representation of the data types of the values to insert
 * @param type $dbCon A database connection
 */
function insert($valueArray, $table, $columnArray, $types, $dbCon) {
    //check if connection was succesful
    if (connected($dbCon)) {
        //prepare an sql statement
        //because double quotes are used, the values of variables are used. No concatenation needed.
        $prepStatement = mysqli_prepare($dbCon, "INSERT INTO $table($columnArray[0], $columnArray[1], $columnArray[2]) VALUES(?, ?, ?)");
        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            mysqli_stmt_bind_param($prepStatement, $types, $valueArray[0], $valueArray[1], $valueArray[2]);
            //execute prepared statement
            mysqli_stmt_execute($prepStatement);

            //echo 'Insert Successful';
        }
        //close prepared statement
        mysqli_stmt_close($prepStatement);
    }
    //close connection
    mysqli_close($dbCon);
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

/**
 * Delete data from database
 * @param type $key The key that determines which record to delete.
 * @param type $table The table to delete from.
 * @param type $column The column to delete data from.
 * @param type $types A string representation of the data type of the key for deletion
 * @param type $dbCon A database connection
 */
function delete($key, $table, $column, $types, $dbCon) {
    //check if connection was succesful
    if (connected($dbCon)) {
        //prepare an sql statement
        $prepStatement = mysqli_prepare($dbCon, "DELETE FROM $table WHERE $column = ?");
        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            mysqli_stmt_bind_param($prepStatement, $types, $key);
            //execute prepared statement
            mysqli_stmt_execute($prepStatement);

            //echo 'Delete Successful';
        }
        //close prepared statement
        mysqli_stmt_close($prepStatement);
    }
    //close connection
    mysqli_close($dbCon);
}

/**
 * Updates a record in a database
 * Allows update in webtechlogin, webtechtable and customer tables
 * @param type $valueArray An array of values to update the database
 * @param type $key The key that determines which record to update.
 * @param type $table The table to update.
 * @param type $column The column to delete data from.
 * @param type $types A string representation of the data type of the key for update
 * @param type $dbCon A database connection
 */
function update($valueArray, $key, $table, $column, $types, $dbCon) {
    //check if connection was succesful
    if (connected($dbCon)) {
        //prepare an sql statement
        $prepStatement;

        //For webtechlogin
        if ($table == 'webtechlogin') {
            $prepStatement = mysqli_prepare($dbCon, "UPDATE $table SET username = ?, passwd = ?  WHERE $column = ?");
            //check if prepared statement was successful
            if ($prepStatement) {
                //bind parameters
                mysqli_stmt_bind_param($prepStatement, $types, $valueArray[0], $valueArray[1], $key);
                //execute prepared statement
                mysqli_stmt_execute($prepStatement);
                //echo 'Update Successful';
            }
        }

        //For webtechtable
        elseif ($table == 'webtechtable') {
            $prepStatement = mysqli_prepare($dbCon, "UPDATE $table SET username = ?, gender = ?, color = ?  WHERE $column = ?");
            //check if prepared statement was successful
            if ($prepStatement) {
                //bind parameters
                mysqli_stmt_bind_param($prepStatement, $types, $valueArray[0], $valueArray[1], $valueArray[2], $key);
                //execute prepared statement
                mysqli_stmt_execute($prepStatement);
                //echo 'Update Successful';
            }
        }

        //For customer
        elseif ($table == 'customer') {
            $prepStatement = mysqli_prepare($dbCon, "UPDATE $table SET cus_fname = ?, cus_lname = ?, cus_uname = ?, cus_email = ?, cus_pw = ?  WHERE $column = ?");
            //check if prepared statement was successful
            if ($prepStatement) {
                //bind parameters
                mysqli_stmt_bind_param($prepStatement, $types, $valueArray[0], $valueArray[1], $valueArray[2], $valueArray[3], $valueArray[4], $key);
                //execute prepared statement
                mysqli_stmt_execute($prepStatement);
                //echo 'Update Successful';
            }
        }

        //close prepared statement
        mysqli_stmt_close($prepStatement);
    }
    //close connection
    mysqli_close($dbCon);
}

/**
 *
 * @param type $key
 * @param type $table
 * @param type $column
 * @param type $types
 * @param type $dbCon
 * @return type
 */
function select($key, $table, $column, $types, $dbCon) {
    $result;
    $out_uname;
    $out_gend;
    $out_out;
    $output = array();

    //check if connection was succesful
    if (connected($dbCon)) {
        //prepare an sql statement
        $prepStatement;
        if ($table == 'webtechlogin') {
            $prepStatement = mysqli_prepare($dbCon, "SELECT $column FROM $table WHERE username = ?");
        }


        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            mysqli_stmt_bind_param($prepStatement, $types, $key);
            //execute prepared statement
            mysqli_stmt_execute($prepStatement);
            //$result = mysqli_stmt_get_result($prepStatement);
            mysqli_stmt_bind_result($prepStatement, $passwd);
            if (mysqli_stmt_fetch($prepStatement)) {
                $output[0] = $passwd;
            }
        }
    }
    return $output;
}

function getAllUsernames($key, $table, $dbCon){
    $result = NULL;
    $searchTerm = "%" . $keyword . "%";
    //check if connection was succesful
    if (connected($dbCon)) {
        //prepare an sql statement
        $prepStatement = mysqli_prepare($dbCon, "SELECT username FROM $table WHERE $column LIKE ?");

        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            mysqli_stmt_bind_param($prepStatement, $types, $searchTerm);

            //execute prepared statement
            mysqli_stmt_execute($prepStatement);
            $result = mysqli_stmt_get_result($prepStatement);
        }
    }
    return $result;
}

/**
 * Searches the database for values similar to the keyword entered.
 * Returns the entire result.
 * @param type $keyword Search term
 * @param type $table Table in database to search from
 * @param type $column The column to
 * @param type $types The data type of the keyword to search from
 * @param type $dbCon A database connection
 * @return type Returns a result variable that can be traversed in a loop
 * using the database column names. or NULL if otherwise.
 */
function search($keyword, $table, $column, $types, $dbCon) {
    $result = NULL;
    $searchTerm = "%" . $keyword . "%";
    //check if connection was succesful
    if (connected($dbCon)) {
        //prepare an sql statement
        $prepStatement = mysqli_prepare($dbCon, "SELECT * FROM $table WHERE $column LIKE ?");

        //check if prepared statement was successful
        if ($prepStatement) {
            //bind parameters
            mysqli_stmt_bind_param($prepStatement, $types, $searchTerm);

            //execute prepared statement
            mysqli_stmt_execute($prepStatement);
            $result = mysqli_stmt_get_result($prepStatement);
        }
    }
    return $result;
}

/* ----------------------SESSION METHODS---------------------------------
  ---------------------------------------------------------------------- */

function exists($session) {

}

/**
 * Checks if a password entered by user matches that of the correct password
 * in the database.
 * @param type $password Password entered by the user
 * @param type $correctPassword Correct password in the database
 * @return boolean Returns true if it matches, and false otherwise.
 */
function authenticate($password, $correctPassword) {
    //verify password using password_verify()
    $matches = password_verify($password, $correctPassword);
    //return true if it matches or false if otherwise
    if ($matches) {
        return true;
    } else {
        return false;
    }
}

function testPrint() {
    echo 'Test print. Means init.php included successfully';
}

