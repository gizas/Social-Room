<?php
	
   include 'config.inc.php';

	echo "<div id=\"response\">";


  $from            = $_POST['from'];
  $message1            = $_POST['message1'];
  $message2            = $_POST['message2'];
  
  if ( ($from=='') && ($message1=='') && ($message2=='')) { 
  
  		echo "<p><span>No message send</span></em></p>";
  	
  }
else{
	$query1 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE userName='$from'" );
  $info1 = mysql_fetch_array( $query1 ); 
  $k=$info1[ID];


  $query3 = mysql_query( "SELECT name,email,my_id
						FROM user_info WHERE name='$message1' OR email='$message2'" );

  $info3 = mysql_fetch_array( $query3 ); 

  $querya = "INSERT INTO notifications (from_id,to_id,message)
             VALUES ('$k',
                     '$info3[my_id]',
                     'Friend Reguest!'
                     )";
  
mysql_query($querya) or die('No user with such name');

  	 	echo "<p>Your notification was sent to the user!</p>";
	 	echo"$info3[name]";

  		}  
  echo "</div>";
  

?>         
            
            
            