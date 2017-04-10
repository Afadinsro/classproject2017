<?php

/**
 * 
 * @author Joseph Odarkwei Mills <mills.josef@gmail.com>
 * @version 1.0
 */
require_once dirname(__FILE__) . "/../settings/core.php";
require_once dirname(__FILE__) . "/../unsecure/retrieval_functions.php";
require_once dirname(__FILE__) . "/../unsecure/form_validation.php";
require_once dirname(__FILE__) . "/../controller/define.php";


/**
 * Description of User
 *
 * @author afadinsro
 */
class User implements Serializable {

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
     * @param int $new Determines whether this user is new (1) or a duplicate (0)
     * @param string $username
     * @param string $fname
     * @param string $lname
     * @param string $password Password should be at least 8 characters long.
     * @param string $email
     * @param string $gender
     * @param int $major_id
     * @param int $per_id
     */
    public function __construct(int $new, string $username, string $fname, string $lname, string $password, string $email, string $gender, int $major_id, int $per_id) {


        //values given must be valid
        $is_valid = $this->is_valid($new, $username, $fname, $lname, $password, $email, $gender, $major_id, $per_id);
        if ($is_valid) {
            //all usernames must be lowercase
            $this->username = strtolower($username);
            $this->fname = $fname;
            $this->lname = $lname;
            $this->password = $password;
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
     * @param int $new Description
     * @param string $username
     * @param string $fname
     * @param string $lname
     * @param string $pwd
     * @param string $email
     * @param string $gend
     * @param int $major_id
     * @param int $per_id
     * @return boolean
     */
    private function is_valid(int $new, string $username, string $fname, string $lname, string $pwd, string $email, string $gend, int $major_id, int $per_id) {
        $valid = FALSE;
        //username should not exist i.e unique
        //password should match regex
        //email should not exist i.e unique
        //email should match regex
        //major_id shoulf exist
        //per_id should exist
        //fname, lname & username should be strings and should only contain letters


        if ($this->valid_username($username) == TRUE && validatePassword($pwd) == TRUE && validateEmail($email) == TRUE && $this->major_exists($major_id) == TRUE && $this->per_exists($per_id) == TRUE && $this->valid_gender($gend) == TRUE && $this->valid_fname($fname) == TRUE && $this->valid_lname($lname) == TRUE) {
            $valid = TRUE;
        }

        if ($new === DUPLICATE_USER) {
            $valid += $this->username_exists($username) && $this->email_exists($email);
        } elseif ($new === NEW_USER) {
            $valid += !$this->username_exists($username) && !$this->email_exists($email);
        }

        /* if (User::valid_username($username) == TRUE 
          && validatePassword($pwd) == TRUE
          && validateEmail($email) == TRUE && User::major_exists($major_id) == TRUE
          && User::per_exists($per_id) == TRUE && User::valid_gender($gend) == TRUE
          && User::valid_fname($fname) == TRUE && User::valid_lname($lname) == TRUE) {
          $valid = TRUE;
          }

          if($new === DUPLICATE_USER){
          $valid += User::username_exists($username) && User::email_exists($email);
          }elseif($new === NEW_USER){
          $valid += !User::username_exists($username) && !User::email_exists($email);
          } */

        return $valid;
    }

    /**
     * 
     * @return \User
     */
    public static function getDefault() {
        return new User(NEW_USER, DEFAULT_NAME, DEFAULT_NAME, DEFAULT_NAME, DEFAULT_PASSWORD, DEFAULT_EMAIL, DEFAULT_GENDER, DEFAULT_MAJOR, STUDENT_PERMISSION);
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
                if ($email === $record['email']) {
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
                if ($username === $record['username']) {
                    $success = TRUE;
                    break;
                }
            }
        }
        return $success;
    }

    public function test($username, $email) {
        switch ($this->username_exists($username)) {
            case TRUE:
                echo 'username exists';
                break;
            case FALSE:
                echo 'username exists';
                break;
        }
        switch ($this->username_exists($email)) {
            case TRUE:
                echo 'email exists';
                break;
            case FALSE:
                echo 'email exists';
                break;
        }
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
                if ($per_id === $record['perid']) {
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
                if ($major_id === $record['majorid']) {
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
    /* private function changeUserStatus(User $user) {
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
      } */

    /* ---------------------------------------------------------------------
     *                           Setter Methods
      -------------------------------------------------------------------- */
    public function setStatus(string $status) {
        $success = FALSE;
        switch (strtoupper($status)) {
            case "ACTIVE":
            case "INACTIVE":
                $this->status = strtoupper($status);
                $success = TRUE;
                break;
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
    public function getPassword() {
        return $this->password;
    }

    public function display() {
        $array = $this->toArray();
        foreach ($array as $value) {
            echo $value . '<br>';
        }
    }

    /* ---------------------------------------------------------------------
     *                           Serializable Methods
      -------------------------------------------------------------------- */

    public function serialize() {
        return serialize($this->toArray());
    }

    public function unserialize($serialized) {
        return unserialize($serialized);
    }

    public static function init(Array $array) {
        $new_user = new User(DUPLICATE_USER, $array[0], $array[1], $array[2], $array[3], $array[4], $array[5], $array[6], $array[8]);

        $new_user->setStatus($array[7]);

        return $new_user;
    }

    /* ---------------------------------------------------------------------
     *                           Special Methods
      -------------------------------------------------------------------- */

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

}
