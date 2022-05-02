<?php

  /** 
   * Validates the presence of data in a trimmed variable 
   * 
   * @param string $value The variable to evaluate
   * @return boolean ex. False if variable contains data 
   */
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  /** 
   * Tests a trimmed string for a minimum length
   *   
   * @param string $value The string to test 
   * @param number $min The threshold length
   * @return boolean ex. False if string length equals the minimum
   */
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  /** 
   * Tests a trimmed string for a maximum length
   *   
   * @param string $value The string to test 
   * @param number $max The threshold length
   * @return boolean ex. False if string length equals the maximum
   */
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  /** 
   * Tests a trimmed string for an exact length
   *   
   * @param string $value The string to test 
   * @param number $exact The ideal length
   * @return boolean ex. True if string length equals the ideal
   */
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  /** 
   * Tests a string against specified min, max, and exact lengths
   *  
   * @param string $value The string to test
   * @param array $options An associated array of length requirements, ex. ['min' => 6, 'max' => 32] 
   * @return boolean Whether the string meets the requirements 
   */
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  /** 
   * Evaluates a string for proper email format, ex. "me@example.com" 
   * 
   * @param string $value The string to check the format of 
   * @return boolean ex. False for an invalid email format 
   */
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

  /** 
   * Tests an email for unique database entry
   *  
   * @param string $email The email to search for
   * @return boolean ex. True if the email is not found in the database
   */
  function has_unique_email($email, $current_id="0") {
    $user = User::find_by_email($email);
    if($user === false || $user->id == $current_id) {
      // is unique
      return true;
    } else {
      // not unique
      return false;
    }
  }
  
  /** 
   * Tests if a date is more recent than a threshhold
   * 
   * @param date $value The date to test
   * @param date $min The threshhold to test against
   * @return boolean ex. False if the dates are the same
   */
  function has_date_greater_than($value, $min) {
    return $value > $min;
  }
  
  /** 
   * Tests if a date is less recent than a threshhold
   * 
   * @param date $value The date to test
   * @param date $min The threshhold to test against
   * @return boolean ex. True if the date is less recent
   */
  function has_date_less_than($value, $max) {
    return $value < $max;
  }
  
  /** 
   * Tests a date against specified min, max, and exact values 
   * 
   * @param string $value The date to test
   * @param array $options An associated array of requirements, ex. ['min' => '1991-01-01, 'max' => '2001-01-01'] 
   * @return boolean Whether the string meets the requirements
   */
  function has_date($value, $options) {
    if(isset($options['min']) && !has_date_greater_than(strtotime($value), strtotime($options['min'] . ' - 1 day'))) {
      return false;
    } elseif(isset($options['max']) && !has_date_less_than(strtotime($value), strtotime($options['max'] . ' + 1 day'))) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly(strtotime($value), strtotime($options['exact']))) {
      return false;
    } else {
      return true;
    }
  }
  
  /** 
   * Tests a string for whitespace at the beginning or end 
   * 
   * @param string $string The string to test 
   * @return boolean ex. True if the string begins with a space 
   */
  function has_padding($string) {
    if ($string == trim($string)) {
      return false;
    } else {
      return true;
    };
  }
  
  /** 
   * Tests a string for containing whitespace
   * 
   * @param string $string The string to test 
   * @return boolean ex. True if the string contains a space 
   */
  function has_spaces($string) {
    if(strpos($string, ' ')){
      return true;
    } elseif(preg_match('/\s/', $string)) {
      return true;
    } else {
      return false;
    };
  }
  
  /** 
   * Tests a string for inclusion of only letters, dashes, and spaces
   *  
   * @param string $string The string to test 
   * @return boolean ex. False if the sting contains other characters 
   */
  function has_valid_name($string) {
    return !preg_match('/[^a-z\s-]/i',$string);
  }
  
  /** 
   * Tests a string for inclusion of only letters, numbers, dashes, and spaces
   *  
   * @param string $string The string to test 
   * @return boolean ex. False if the sting contains other characters 
   */
  function has_valid_char($string) {
    return !preg_match('/[^a-z0-9\s-]/i',$string);
  }
  
  /** 
   * Tests a string for inclusion of only letters, numbers, and common punctuation 
   * 
   * @param string $string the string to test 
   * @return boolean ex. False if the sting contains other characters  
   */
  function has_valid_text($string) {
    return !preg_match('/[A-Za-z0-9 _.,-!"\'$/]*', $string);
  }
  
  /** 
   * Tests a string for valid URL format, ex. "https://example.com" 
   * 
   * @param string $website The string to test 
   * @return boolean ex. True if the URL is a valid format 
   */
  function has_valid_url($website) {
    return preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website);
  }
  
  /** 
   * Tests a string for inclusion of only numerals in integer or decimal format 
   *  
   * @param string $string The string to test
   * @return boolean ex. True if the string is 9.99
   */
  function has_decimal_format($string) {
    return preg_match('/([0-9]+\.[0-9]+)/', $string);
  }
  
?>