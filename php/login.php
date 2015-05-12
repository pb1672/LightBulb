<?php
session_start();
  /* putuser.php  */
  /* Used to add new user profiles to our database
  /* Jonathan Holding  */

  /* soak in the passed variable or set our own */
  
  
  $email = mysql_real_escape_string($_POST['email']); 
  $password = mysql_real_escape_string($_POST['password']); 
  
 
  /* connect to the db */
  $link = mysql_connect('websys3.stern.nyu.edu','websysS15GB5','websysS15GB5!!') or die('Cannot connect to the DB');
  mysql_select_db('websysS15GB5',$link) or die('Cannot select the DB');
 
  
   $query = "SELECT profile_id,fname,lname,email,education,company  FROM profile WHERE email ='" . $email . "' and password = '" . $password . "'";  //Check working
  
  $result = mysql_query($query,$link) or die('Errant query:  '.$query);

  $return = -1;
 
  $num_rows = mysql_num_rows($result);    

  if (intval($num_rows) > 0)
  {
      $row = mysql_fetch_array($result);//display the results
      $return =   intval($row['profile_id']) ;
      $_SESSION["useremail"] = $email;
      $_SESSION["userID"] = intval($row['profile_id']) ;
  } 

  header('Content-type: application/json'); 
  echo json_encode($return);
 
 //echo $query;
  /* disconnect from the db */
  @mysql_close($link);

?>

