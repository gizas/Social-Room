<?php
	
   include 'config.inc.php';

	echo "<div id=\"response\">";


  $from            = $_POST['from'];
  $to            = $_POST['to'];
  $message            = $_POST['message'];
  $id                 =$_POST['id'];

  if ( ($from=='') && ($to=='') && ($message=='')) { 
  
  		echo "<p><span>Δεν έγινε η διαγραφή</span></em></p>";
  	
  }
  else {$query1 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE ID='$from'" );

  $info1 = mysql_fetch_array( $query1 ); 
  
$query2 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE ID='$to'" );

  $info2 = mysql_fetch_array( $query2 ); 
  
  $querya = "INSERT INTO user_friends (user_id,friend_id,remarks)
             VALUES ('$info1[ID]',
                     '$info2[ID]',
                     '$message'
                     )";
  $queryb = "INSERT INTO user_friends (user_id,friend_id,remarks)
             VALUES ('$info2[ID]',
                     '$info1[ID]',
                     '$message'
                     )";
  
mysql_query($querya) or die('Δεν έγινε η αποστολή δεδομένων');
mysql_query($queryb);

  $queryf = mysql_query("DELETE FROM notifications WHERE id = '$id'");
mysql_query($queryf);
  	 	echo "<p>Είστε πλέον φίλοι με τον/ την !</p>";
	 	echo"$info1[userName]";
		}  
  echo "</div>";
  

?>         
            
            
            