<?php
session_start();
  /* putuser.php  */
  /* Used to add new user profiles to our database
  /* Jonathan Holding  */

  /* soak in the passed variable or set our own */
  
  $fname = mysql_real_escape_string($_POST['fname']);
  $lname = mysql_real_escape_string($_POST['lname']);
  $education = mysql_real_escape_string($_POST['education']);
  $company = mysql_real_escape_string($_POST['employment']);
  $innovator = mysql_real_escape_string($_POST['innovator']);
  $collaborator = mysql_real_escape_string($_POST['collaborator']);
  $mentor = mysql_real_escape_string($_POST['mentor']);
  $investor = mysql_real_escape_string($_POST['investor']);
  $email = mysql_real_escape_string($_POST['email']); 
  $password = mysql_real_escape_string($_POST['password']); 
  
 
  /* connect to the db */
  $link = mysql_connect('websys3.stern.nyu.edu','websysS15GB5','websysS15GB5!!') or die('Cannot connect to the DB');
  mysql_select_db('websysS15GB5',$link) or die('Cannot select the DB');
 
  
   /* Now put in the new/replacement row  */

  $query = "INSERT INTO profile(email,password,fname,lname,education,company,innovator,collaborator,mentor,investor) VALUES (";
  $query = $query."'"."$email"."',";
  $query = $query."'"."$password"."',";
  $query = $query."'"."$fname"."',";
  $query = $query."'"."$lname"."',";
  $query = $query."'"."$education"."',";
  $query = $query."'"."$company"."',";
  $query = $query."'"."$innovator"."',";
  $query = $query."'"."$collaborator"."',";
  $query = $query."'"."$mentor"."',";
  $query = $query."'"."$investor"."')";

  $result = mysql_query($query,$link) or die('Errant query:  '.$query);
 
 //IMPORTANT Pull automatically generated profile_id to store as a session variable
  $result = mysql_insert_id();    

  if ($result >0)
  {
      $_SESSION["userID"] = intval($result) ;
      $_SESSION["useremail"] = $email;
}
  header('Content-type: application/json'); 
  echo json_encode($result);
 
  /* disconnect from the db */
  @mysql_close($link);

?>

