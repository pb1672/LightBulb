<?php
  /* putuser.php  */
  /* Used to add new user profiles to our database
  /* Jonathan Holding  */

  /* soak in the passed variable or set our own */
  
  
  $email = mysql_real_escape_string($_POST['email']); 
  $password = mysql_real_escape_string($_POST['password']); 
  
 
  /* connect to the db */
  $link = mysql_connect('websys3.stern.nyu.edu','websysS15GB5','websysS15GB5!!') or die('Cannot connect to the DB');
  mysql_select_db('websysS15GB5',$link) or die('Cannot select the DB');
 
  
   $query = "SELECT profile_id,fname,lname,email,education,company  FROM profile WHERE email ='" . $profile_id . "' and password = '" . $password . "'";  //Check working
  
  $result = mysql_query($query,$link) or die('Errant query:  '.$query);

  
 
  $num_rows = mysql_num_rows($result);    

  header('Content-type: application/json'); 
  echo json_encode($num_rows);
 
  /* disconnect from the db */
  @mysql_close($link);

?>

