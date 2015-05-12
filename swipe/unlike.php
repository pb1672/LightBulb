<?php
session_start();
  /* putuser.php  */
  /* Used to add new user profiles to our database
  /* Jonathan Holding  */

  /* soak in the passed variable or set our own */
 $idea_id = intval($_POST['id']);
  $user = $_SESSION["userID"];
 
  /* connect to the db */
  $link = mysql_connect('websys3.stern.nyu.edu','websysS15GB5','websysS15GB5!!') or die('Cannot connect to the DB');
  mysql_select_db('websysS15GB5',$link) or die('Cannot select the DB');
 
  
   /* Now put in the new/replacement row  */

  $query = "UPDATE idea SET LikeCount = LikeCount - 1 where idea_ID =" . $idea_id ;
  

  $result = mysql_query($query,$link) or die('Errant query:  '.$query);

   $date = date('Y-m-d H:i:s');
   $query = "INSERT INTO tblSwipe  values ($idea_id,$user,'" . $date . "','NO');" ;
  

  $result = mysql_query($query,$link) or die('Errant query:  '.$query);
 
 //IMPORTANT Pull automatically generated idea_id to store as a session variable
  //$result = mysql_insert_id();    

  //header('Content-type: application/json'); 
  //echo json_encode($result);
  echo $result;
  /* disconnect from the db */
  @mysql_close($link);

?>

