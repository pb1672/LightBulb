<?php
session_start();
$link=mysql_connect("websys3.stern.nyu.edu","websysS15GB5","websysS15GB5!!")or die('Cannot connect to the DB');
mysql_select_db("websysS15GB5",$link) or die('Cannot select the DB');

// Get values from form 

//$PHONENUMBER = $_POST['user'];


//$format =  'json';
$user = $_SESSION["userID"];
$query = "select * from idea  where profile_ID NOT IN ($user) and idea_ID NOT IN (select idea_ID from tblSwipe where profile_ID = $user) order by idea_ID DESC;";

$result = mysql_query($query,$link) or die('Errant query:  '.$query);

$str = "";
$count = 0;
while ($row = mysql_fetch_array($result))
{

 
   
     $str = $str . "<div id='div" . $row['idea_ID'] .  "' title='"  . $row['idea_ID'] . "' class='buddy' style='display: block;'><div class='avatar'  style='display: block;'><div style='padding:2px 0px 2px 5px;'><b>Problem:</b><hr>"  . $row['problem'] . "<br><br><br><b>Solution:</b><hr>" . $row['solution'] . "<br><br><br>Likes:<hr>" . $row['LikeCount'] . "- " . $row['idea_ID'] . "</div></div></div>";
}
if ($str == "")
	$str = "err";
echo $str ;

	

	/*echo "<div title='1' class='buddy' style='display: block;'><div class='avatar'  style='display: block; background-image: url(https://pbs.twimg.com/profile_images/489309610071715840/e3dOtcy1.jpeg)'></div></div>
	    <div  title='2' class='buddy'><div class='avatar' style='display: block; background-image: url(https://pbs.twimg.com/profile_images/1132920415/39693_465193641456_586141456_6088294_2034896_n.jpg)'></div></div>  
	    <div  title='3' class='buddy'><div class='avatar' style='display: block; background-image: url(http://media.idownloadblog.com/wp-content/uploads/2014/02/elon-musk-tesla.jpg)'></div></div>  
	    <div   title = '4' class='buddy'><div class='avatar' style='display: block; background-image: url(http://static.168ora.hu/db/09/AF/orban-d0001C9AFa1ba9618c180.jpg)'></div></div>"; */
@mysql_close($link);

?>








 