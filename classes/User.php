<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../unsecure/retrieval_functions.php';
require_once '../unsecure/form_validation.php';

define('DEFAULT_STATUS', 'ACTIVE');
define('STUDENT_PERMISSION', 2);
define('FACULTY_PERMISSION', 3);
define('ADMIN_PERMISSION', 1);
/**
 * Description of User
 *
 * @author afadinsro
 */
class User {

    //put your code here
    public $username;
    public $fname;
    public $lname;
    private $password;
    private $email;
    public $gender;
    public $major_id;
    public $status;
    public $per_id;
    
    

    /**
     * 
     * @param string $username
     * @param string $fname
     * @param string $lname
     * @param string $password Password should be at least 8 characters long.
     * @param string $email
     * @param string $gender
     * @param int $major_id
     * @param int $per_id
     */
    public function __construct(string $username, string $fname, string $lname, string $password, string $email, string $gender, int $major_id, int $per_id) {
        //values given must be valid
        $is_valid = $this->is_valid($username, $fname, $lname, $password, $email, $gender, $major_id, $per_id);
        if ($is_valid) {
            //all usernames must be lowercase
            $this->username = strtolower($username);
            $this->fname = $fname;
            $this->lname = $lname;
            //password should be hashed
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            $this->email = $email;
            //gender should be uppercase
            $this->gender = strtoupper($gender);
            $this->major_id = $major_id;
            $this->status = DEFAULT_STATUS;
            $this->per_id = $per_id;
        }
    }

    /**
     * 
     * @param User $user
     * @return boolean
     */
    public function addUser(User $user) {
        $success = FALSE;
        //user has to be admin before they can add another user
        if ($this->per_id === 1) {
            register($user);
        }
        return $success;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        $array = array();
        //push user details into array
        array_push($array, $this->username);
        array_push($array, $this->fname);
        array_push($array, $this->lname);
        array_push($array, $this->password);
        array_push($array, $this->email);
        array_push($array, $this->gender);
        array_push($array, $this->major_id);
        array_push($array, $this->status);
        array_push($array, $this->per_id);
        //return array
        return $array;
    }

    private function is_valid(string $username, string $fname, string $lname, string $pwd, string $email, string $gend, int $major_id, int $per_id) {
        $valid = FALSE;
        //username should not exist i.e unique
        //password should match regex
        //email should not exist i.e unique
        //email should match regex
        //major_id shoulf exist
        //per_id should exist
        //fname, lname & username should be strings and should only contain letters
        
        echo 'before check';

        if ($this->username_exists($username) == FALSE && $this->valid_username($username) == TRUE 
                && validatePassword($pwd) == TRUE && $this->email_exists($email) == FALSE 
                && validateEmail($email) == TRUE && $this->major_exists($major_id) == TRUE 
                && $this->per_exists($per_id) == TRUE && $this->valid_gender($gend) == TRUE 
                && $this->valid_fname($fname) == TRUE && $this->valid_lname($lname) == TRUE) {
            echo 'check successful';
            $valid = TRUE;
        }
        $bool = $valid ? 'true': 'false';
        echo '<br>'.$bool;
        return $valid;
    }

    /**
     * Checks the email given already exists in the database
     * @param string $email Email to check for existence
     * @return boolean True if the email already exists, false if otherwise
     */
    private function email_exists(string $email) {
        $success = FALSE;
        $existing = getEmails();
        
        if ($existing != NULL) {
            foreach ($existing as $record) {
                if ($email === $record['email']){
                    $success = TRUE;
                    break;
                }
            }
        }
        return $success;
    }

    /**
     * 
     * @param string $username
     * @return boolean
     */
    private function username_exists(string $username) {
        $success = FALSE;
        $existing = getUsernames();
        
        if ($existing != NULL) {
            foreach ($existing as $record) {
                if ($username === $record['username']){
                    $success = TRUE;
                    break;
                }
            }
        }
        return $success;
    }

    /**
     * 
     * @param int $per_id
     * @return boolean
     */
    private function per_exists(int $per_id) {
        $success = FALSE;
        $existing = getPermissions();
        
        if ($existing != NULL) {
            foreach ($existing as $record) {
                if ($per_id === $record['perid']){
                    $success = TRUE;
                    break;
                }
            }
        }
        return $success;
    }

    /**
     * 
     * @param int $major_id
     * @return boolean
     */
    private function major_exists(int $major_id) {
        $success = FALSE;
        $existing = getMajors();
        
        if ($existing != NULL) {
            foreach ($existing as $record) {
                if ($major_id === $record['majorid']){
                    $success = TRUE;
                    break;
                }
            }
        }
        return $success;
    }

    /**
     * 
     * @param string $gender
     * @return boolean
     */
    private function valid_gender(string $gender) {
        $success = FALSE;

        switch ($gender) {
            case 'M':
            case 'F':
                $success = TRUE;
                break;
        }
        return $success;
    }

    /**
     * 
     * @param string $username
     * @return boolean
     */
    private function valid_username(string $username) {
        return is_string($username) && ctype_alpha($username);
    }
    
    /**
     * 
     * @param string $fname
     * @return boolean
     */
    private function valid_fname(string $fname) {
        return is_string($fname) && ctype_alpha($fname); 
    }

    /**
     * 
     * @param string $lname
     * @return boolean
     */
    private function valid_lname(string $lname) {
        return is_string($lname) && ctype_alpha($lname); 
    }
    
    /**
     * 
     * @param User $user
     */
    private function changeUserStatus(User $user) {
        switch ($user->status) {
            case 'ACTIVE':
                $user->status = 'INACTIVE';
                break;
            case 'INACTTIVE':
                $user->status = 'ACTIVE';
                break;
        }
    }

    public function changeStatus(User $user, bool $self) {
        $success = FALSE;
        //you can change your status
        if ($user === $this && $user->per_id !== 1) {
            changeUserStatus($this);
            $success = TRUE;
        }
        //user is another user
        //only admins can change status of others 
        elseif ($user !== $this && $user->per_id === 1) {
            changeUserStatus($user);
            $success = TRUE;
        }

        return $success;
    }
    
    
    
    /* ---------------------------------------------------------------------
     *                           Getter Methods
      -------------------------------------------------------------------- */

    /**
     * 
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * 
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * 
     * @return string
     */
    private function getPassword() {
        return $this->password;
    }
    
    public function display() {
        $array = $this->toArray();
        foreach ($array as $value) {
            echo $value.'<br>';
        }
    }

}

$username = 'dxd';
$fname = 'Derrick';
$lname = 'Dowuona';
$password = 'enigmadxd';
$email = 'derrick.dowuona@ashesi.edu.gh';
$gender = 'M';
$major_id = 1;
$per_id = 2;

$user = new User($username, $fname, $lname, $password, $email, $gender, $major_id, $per_id);

$user->display();

echo "$user->lname";