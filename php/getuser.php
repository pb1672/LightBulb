<?php
session_start();
  /* getuser.php  */
  /* Parsed profile_id, gets key user info and returns an array of details to be displayed
  /* Jonathan Holding  */

  /* Get profile id */
  
  $profile_id = intval($_POST['id']);
  //$profile_id = 308;
  /* connect to the db */
  $link = mysql_connect('websys3.stern.nyu.edu','websysS15GB5','websysS15GB5!!') or die('Cannot connect to the DB');
  mysql_select_db('websysS15GB5',$link) or die('Cannot select the DB');
 
  /* Query DB for profile details of profile_id */
  $format = 'json';
  
  $query = "SELECT profile_id,fname,lname,email,education,company  FROM profile WHERE profile_id = $profile_id";  //Check working
  
  $result = mysql_query($query,$link) or die('Errant query:  '.$query);

  

//fetch the results
  $row = mysql_fetch_array($result);

//display the results
  $test =  $row['profile_id'] . "$$" . $row['fname'] . "$$" . $row['email'] . "$$"  . $row['lname'] . "$$" . $row['education'];

  //json_encode("{");
  echo $test;

  
  
  /* disconnect from the db */
  @mysql_close($link);

?>

