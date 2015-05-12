<?php
session_start();
  /* putuser.php  */
  /* Used to add new user profiles to our database
  /* Jonathan Holding  */

  /* soak in the passed variable or set our own */
  
  $problem = mysql_real_escape_string($_POST['problem']);
  $solution = mysql_real_escape_string($_POST['idea']);
  $stage = mysql_real_escape_string($_POST['stage']);
  $thoughts = mysql_real_escape_string($_POST['thoughts']);
  $user = $_SESSION['userID'];
 
  /* connect to the db */
  $link = mysql_connect('websys3.stern.nyu.edu','websysS15GB5','websysS15GB5!!') or die('Cannot connect to the DB');
  mysql_select_db('websysS15GB5',$link) or die('Cannot select the DB');
 
  
   /* Now put in the new/replacement row  */

  $query = "INSERT INTO idea(problem,solution,stage,thoughts,profile_id) VALUES (";
  $query = $query."'"."$problem"."',";
  $query = $query."'"."$solution"."',";
  $query = $query."'"."$stage"."',";
  $query = $query."'"."$thoughts"."',$user)";

  $result = mysql_query($query,$link) or die('Errant query:  '.$query);
 
 //IMPORTANT Pull automatically generated idea_id to store as a session variable
  $result = mysql_insert_id();    

  //header('Content-type: application/json'); 
  //echo json_encode($result);
 echo $user;
  /* disconnect from the db */
  @mysql_close($link);

?>

