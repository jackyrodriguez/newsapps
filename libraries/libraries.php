<?php
// initialize Globaly
$db = new db(DB_USER, DB_PASSWD, DB_NAME, DB_HOST);
?>
<?php 
//  The Main Class  
class db {
  //  DB Constructor - connects to the server and selects a database
  public function db($dbuser, $dbpassword, $dbname, $dbhost)
  { 
    $this->dbh = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    
    if ( !$this->dbh )
    {
      $this->print_error("<ol><b>Error establishing a database connection!</b><li>Are you sure you have the correct user/password?<li>Are you sure that you have typed the correct hostname?<li>Are you sure that the database server is running?</ol>");
    }
    
    //$this->select($dbname);
    
    if(mysqli_connect_errno())
    {
        die('The connection to the database could not be established.');
    }
  }

  public function __call($function, $args) 
  {
    $args = implode(', ', $args);
    trigger_error("Call to $function() with args '$args' failed!", E_USER_WARNING);
    return false;
  }

  /**
  * get_all_in
  * Retrieve all in table
  * 
  * @access public
  * @param  string  table_name 
  * @return  array
  */
  public function get_all_in($table_name='')
  {
    $result = null;
    $query = 'SELECT * FROM ' . $table_name;
    $result = $this->dbh->query($query);
    
    if ($result->num_rows) {

      while ( $row = $result->fetch_assoc())
      { 
        // Store result as main array
        $this->all_result[] = $row;
      }
      $result->free();

      return $this->all_result; 
    }
    
  }

  /**
  * get_col
  * use in admin and frontend/onsite
  *
  * Retrieve all or specific rows,
  *  with specific columns provided
  *  with where clause optional
  * @access public
  * @param  string  table_name  string columns string where
  * @return  array
  */
  public function get_col($table_name='', $columns, $where="")
  {
    // $where args2 ex: id = int AND username = "str" .. 
    // $columns args1 ex: column1, column2, colum3 [ ..fields to be selected ]

    (empty($where))?$where=null:$where = 'WHERE '. $where;

    $result = null;
    $query = "SELECT $columns FROM $table_name $where";

    $result = $this->dbh->query($query);

    if ($result->num_rows) {

      // $result->fetch_object() make object
      while ( $row = $result->fetch_assoc())
      { 
        // Store result as main array
        $this->col_result[] = $row; 
      }
      
      $result->free();
      
      return $this->col_result; 

    } else {
      echo " Validate your sql query where and column clause";
      return false;
    }
    
  }

  /*
  * Retrieve specific row only, select all columns in table
  * with where clause optional
  */
  public function get_row_in($table_name='', $where="")
  {
    // $where args ex: id = int AND username = "str" .. 

    $result = null;
    $query = 'SELECT * FROM ' . $table_name . ' WHERE ' . $where;
    $result = $this->dbh->query($query);
    
    if ($result->num_rows) {

      while ( $row = $result->fetch_assoc())
      {
        // Store result as main array
        $this->last_result[] = $row;
      }
      $result->free();

      //return $this->last_result;
      return $this->last_result[0]?$this->last_result[0]:null; 
    
    } else {
      echo " Validate your sql query where args2 ex: id = int AND username = 'str' ";
      return false;
    }

  }

  /**
  * get_user_details
  * Retrieve specific data using email
  *
  */
  public function get_user_details($user_email = "")
  {
    $result = null;
    $query = "SELECT * FROM users WHERE user_email = '$user_email'";
    
    $result = $this->dbh->query($query);
    
    if ($result->num_rows) {

      $query_result = $result->fetch_assoc();
      $result->free();

      return $query_result;

    } else {

      return false;
    }
  }


  /**
   * build_insert_all_query
   *
   * Add single data 
   *
   * @return  boolean
   */
  public function build_insert_all_query($tablename="",$values=array(), $bind_types)
  {
    $fields     = "";
    $data_values  = "";
    $ctr      = 0;

    $new_values = array();
    $new_values[0] =& $bind_types;
    /*
     * bind the values
     * s for string
     * i for integer
     * d for decimal
     * b for blob
    */
    foreach($values as $key=> $value)
    {
      if( $ctr == 0 )
      {
        $fields     .= "`$key`";
      }
      else
      {
        $fields     .= ",`$key`";
        $query_val  .= ', ?'; 
      }

      //$values[$key] = $this->dbh->real_escape_string($values[$key]);
      //$new_values[] =& $values[$key];

      $new_values[] =& $values[$key];

      $ctr++;
    }

    $sql = "INSERT INTO `$tablename` ( $fields ) VALUES (?". $query_val .")";

    if($stmt = $this->dbh->prepare($sql) ) {

      call_user_func_array(array($stmt, "bind_param"), $new_values);

      // execute the insert query
      if($stmt->execute()){
          
          $stmt->close();
          //echo "User was saved.";
          return true;
      }else{
          die("Unable to save.");
      }
 
    }else{
        die("Unable to prepare statement.");
    }
  }

  /**
   * build_update_all
   *
   * update single data 
   *
   * @return  boolean
   */
  public function build_update_all($tablename="",$values=array(), $bind_types, $where_clause="")
  {
    $fields     = "";
    $data_values  = "";
    $ctr      = 0;

    // automatically add where clause to target the specific id
    if (empty($where_clause) || $where_clause == " ") {
      $where_clause = 'id= ?';
    } 
    $new_values[0] =& $bind_types;
    $countfields = count($values) - 1;

    foreach($values as $key=> $value)
    {
      if( $ctr == 0 )
      {
        $fields     .= "$key = ?";
      }
      elseif($ctr < $countfields)
      {
        $fields     .= ", $key = ?";
      }

      $new_values[] =& $values[$key];

      $ctr++;
    }
    
    $sql = "UPDATE `$tablename` SET $fields WHERE $where_clause";

    if($stmt = $this->dbh->prepare($sql) ) {

      call_user_func_array(array($stmt, "bind_param"), $new_values);

      // execute the insert query
      if($stmt->execute()){
          
          $stmt->close();
          //echo "User was saved.";
          return true;
      }else{
          die("Unable to save.");
      }
 
    }else{
        die("Unable to prepare statement.");
    }
  }

  /**
   * delete
   *
   * delete single data 
   *
   * @return  boolean
   */
  public function delete($tablename="",$id="",$id_val)
  {
    if (isset($id_val)) {
      
    }
    $id_value['id'] = (int)$id_val;

    $sql = "DELETE FROM `$tablename` WHERE `$id` = ?";

    // prepare the sql statement
    if($stmt = $this->dbh->prepare($sql)){
     
        // bind the id of the record to be deleted
        $stmt->bind_param("i", $id_value['id']);
     
        // execute the delete statement
        if($stmt->execute()){
         
            // close the prepared statement
            $stmt->close();
             
            return true;

        }else{
            die("Unable to delete.");
        }
    }
  }


  //  Select a DB (if another one needs to be selected)    
  public function select($new_dbname)
  {
    if (!$db->select_db($new_dbname))
    {
      $this->print_error("<ol><b>Error selecting database <u>$db</u>!</b><li>Are you sure it exists?<li>Are you sure there is a valid database connection?</ol>");
    }
  }

  public function logout_sess()
  {
    // remove session and close database connection
    $this->dbh->close();
    session_destroy();
  }


  //****************** use in frontend ****************** 

  /*
  * Retrieve specific news asc
  * 
  */
  public function get_latest_news($category_name ="")
  {

    $result = null;
    
    if (!empty($category_name) && $category_name != " ") {
      $query = 'SELECT * FROM news WHERE DATE(date) >= DATE(NOW()) AND category = "'. $category_name. '" order by date ASC';
      
      $result = $this->dbh->query($query);
      return $this->fetch_query_news($result);
    }
      return array("no argument pass",false);
  }


  /**
  * fetch_query_news
  *
  * private function
  * @access private 
  */
  private function fetch_query_news($result) 
  {

    if ($result->num_rows) {

      $x=0;
      while ( $row = $result->fetch_assoc())
      {
        // Store result as main array
        $this->query_news_result[$x] = $row;
        $x++;
      }
      $result->free();

      return $this->query_news_result[0]?$this->query_news_result[0]:null; 
    
    } else {
      //echo " Validate your sql query where args2 ex: id = int AND username = 'str' ";
      return false;
    }
  }


  //****************** HELPERS ****************** 
  

  /*
  * Limit words to 50
  *
  */
  public function limit_count_words($text,$number_of_words = 50)
  {
      if($text != null)
      {
          $textarray = explode(" ", $text);
          if(count($textarray) > $number_of_words)
          {
              return implode(" ",array_slice($textarray, 0, $number_of_words))."...";
          }
          return $text;
      }
      return "";
  }


  /*
  * check format
  *
  */
  public function check_date_time($data, $action="")
  {

    $return_value = "";

    if ($action == 'add') {

      if (date('Y-m-d H', strtotime($data)) >= date('Y-m-d H')) {
        if (date('Y-m-d H:i:s', strtotime($data)) == $data || date('Y-m-d H:i', strtotime($data)) == $data) {
          $return_value = true;
        }
        else {
          $return_value = false;  
        }
      }
      else {
        $return_value = false;
      }
      return $return_value;

    } else {  // else action for update, past date is valid

      if (date('Y-m-d H:i:s', strtotime($data)) == $data) {
        $return_value = true;
      } elseif (date('Y-m-d H:i', strtotime($data)) == $data) {
        $return_value = true;
      } else {
        $return_value = false;
      }
        return $return_value;
    } //END condition

  }

  /**
   * _encrypt_string
   *
   * Custom string encryptor, decrypt using _decrypt_string()
   *
   * @access  public
   * @param  string  str  string to encrypt
   * @return  string
   */
  public function _encrypt_string($str)
  {
    $key = '$ABCxyz';
      // Encrypt string
      return bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $str, MCRYPT_MODE_CBC, md5(md5($key))));
  }

  /**
   * _decrypt_string
   *
   * Decrypt using string encrypted by _encrypt_string()
   *
   * @access  public
   * @param  string  str  string to decrypt
   * @return  string
   */
  public function _decrypt_string($str)
  {
    $key = '$ABCxyz';
      // Encrypt string
      $result = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), pack("H*" , $str), MCRYPT_MODE_CBC, md5(md5($key)));

      $error = error_get_last();
      
      if ($result > 0 && empty($error)) {
        return $result;
      } else {
        return false;
      }
  }


  public function printr($arg, $is_vardump=false) 
  {
    if (!$is_vardump) {
      echo "<pre>";
      print_r($arg);
      echo "</pre>";
    } else {
      echo "<pre>";
      var_dump($arg);
      echo "</pre>";
    }
  }


  public function print_error($str = "")
  {
    if ( !$str ) $str = mysqli_error();

    // If there is an error then take note of it
     print "<blockquote><font face=arial size=2 color=ff0000>";
     print "<b>SQL/DB Error --</b> ";
     print "[<font color=000077>$str</font>]";
     print "</font></blockquote>";  
  }


  /**
   * _validate_password
   *
   * Validate provided raw password to the database match hash password.
   *
   * @access  public
   * @param  string  raw_password  plain text password provided by user
   * @param  string  hash_password  hash password from database match
   * @return  boolean
   */
  public function _validate_password($raw_password = NULL, $hash_password = NULL)
  {
      // Hash raw password using crypt(), it will automatically
      // detect the hash type used
      $raw_hash_password = crypt($raw_password, $hash_password);
      
      // Determine if hash raw password matches the database returned
      // hash password digest
      return ($raw_hash_password === $hash_password) ? 1 : 0;
  }


  /**
   * _generate_salt
   *
   * Generate salt using mcrypt_create_iv()
   *
   * @access  private
   * @return  string
   */
  private function _generate_salt()
  {
      // We'll get size of the cipher MCRYPT_CAST_256 and MCRYPT_MODE_CFB
      $iv_size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);

      return bin2hex(mcrypt_create_iv($iv_size, MCRYPT_DEV_RANDOM));
  }


  /**
   * _hash_password
   *
   * Implement password hashing using crypt() CRYPT_SHA256. If no
   * raw password is supplied we return a random hash password (unsecure).
   *
   * @access  public
   * @param  string  raw_password  password to be hash
   * @return  string
   */
  public function _hash_password($raw_password = NULL)
  {
      $crypt_algo = "$5$";
      $crypt_rounds = "500000";

      // Get salt
      $salt = $this->_generate_salt();

      if (empty($raw_password)) {
          // Return hash random password
          return crypt(sha1(mt_rand(157886, mt_getrandmax())), $crypt_algo . "rounds=" . $crypt_rounds . "$" . $salt);
      } else {
          // Return hash raw password
          return crypt($raw_password, $crypt_algo . "rounds=" . $crypt_rounds . "$" . $salt);
      }
  }


  /**
   * _sanitize_string
   *
   * Remove unnecessary or threat characters on strings
   *
   * @access  public
   * @param  string  raw_string  string to be sanitized
   * @return  string
   */
  public function _sanitize_string($raw_string)
  {
      // Strip potential HTML tags
      $raw_string = strip_tags(trim($raw_string));
      
      // Strip slashes in case magic quotes is on, then
      // return sanitized string
      return  get_magic_quotes_gpc() ? stripslashes($raw_string) : $raw_string;
  }


  /**
   * _input_validator _inputValidator
   *
   * Check if supplied input pass the standard of system requirements
   *
   * @access  public
   * @param  string  input_value  input to be validated
   * @param  string  input_type  type of validation to test
   * @return  mixed
   */
  public function _input_validator($input_value, $input_type)
  {
      switch(strtolower($input_type)) {
          case "username":
              // Allow only the following characters on username
              return preg_match('/^[-\wñÑüÜöÖäÄß.]+$/', $input_value) ? 1 : 0;
              break;
          case "email":
              // Let PHP filter_var() handle validating the email format
              return filter_var($input_value, FILTER_VALIDATE_EMAIL);
              break;
          case "name":
              // Allow only the following characters on name
              return preg_match('/^[-.a-zA-ZñÑüÜöÖäÄß\s]+$/', $input_value) ? 1 : 0;
              break;
          default:
              // No type is pass, just return a false
              return false;
              break;
      }
  }


  } // end class
?>