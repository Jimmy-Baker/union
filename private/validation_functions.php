<?php

  // is_blank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  // has_presence('abcd')
  // * validate data presence
  // * reverse of is_blank()
  // * I prefer validation names with "has_"
  function has_presence($value) {
    return !is_blank($value);
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  // * validate string length
  // * combines functions_greater_than, _less_than, _exactly
  // * spaces count towards length
  // * use trim() if spaces should not count
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

  // has_inclusion_of( 5, [1,3,5,7,9] )
  // * validate inclusion in a set
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5,7,9] )
  // * validate exclusion from a set
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  // has_string('nobody@nowhere.com', '.com')
  // * validate inclusion of character(s)
  // * strpos returns string start position or false
  // * uses !== to prevent position 0 from being considered false
  // * strpos is faster than preg_match()
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

  // has_valid_email_format('nobody@nowhere.com')
  // * validate correct format for email addresses
  // * format: [chars]@[chars].[2+ letters]
  // * preg_match is helpful, uses a regular expression
  //    returns 1 for a match, 0 for no match
  //    http://php.net/manual/en/function.preg-match.php
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

  // has_unique_email('johnqpublic')
  // * Validates uniqueness of user.email
  // * For new records, provide only the email.
  // * For existing records, provide current ID as second argument
  //   has_unique_email('johnqpublic', 4)
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
  
  function has_date_greater_than($value, $min) {
    return $value > $min;
  }
  
  function has_date_less_than($value, $max) {
    return $value < $max;
  }
  
  function has_date($value, $options) {
    if(isset($options['min']) && !has_date_greater_than(strtotime($value), strtotime($options['min'] . ' + 1 day'))) {
      return false;
    } elseif(isset($options['max']) && !has_date_less_than(strtotime($value), strtotime($options['max'] . ' + 1 day'))) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly(strtotime($value), strtotime($options['exact']))) {
      return false;
    } else {
      return true;
    }
  }
  
  function has_padding($string) {
    if ($string == trim($string)) {
      return false;
    } else {
      return true;
    };
  }
  
  function has_spaces($string) {
    if(strpos($string, ' ')){
      return true;
    } elseif(preg_match('/\s/', $string)) {
      return true;
    } else {
      return false;
    };
  }
  
  function has_valid_name($string) {
    return !preg_match('/[^a-z\s-]/i',$string);
  }
  
  function has_valid_char($string) {
    return !preg_match('/[^a-z0-9\s-]/i',$string);
  }
  
  function has_valid_url($website) {
    return preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website);
  }
  
  function has_decimal_format($string) {
    return preg_match('/([0-9]+\.[0-9]+)/', $string);
  }
  
  // ctype_alnum($string)
  // ctype_alpha($string)
  // ctype_digit($string)
?>