<?php
	require("class.phpmailer.php");
   include 'config.inc.php';

	echo "<div id=\"response\">";


  $name            = $_POST['name'];
  $message           = $_POST['message'];
  $view       = $_POST['view'];
  $creator      = $_POST['creator'];
  
  if ( ($name=='') && ($message=='')&& ($view=='')) { 
  
  		echo "<p><span>*Ελλειπής Συμπλήρωση</span></em></p>";
  	
  }
  else {
  
	 	echo "<p>Επιτυχης αποστολή!</p>";
		echo "<div>Τίλτος: ".$name."</div>";
	 	echo "<div>Κείμενο: ".$message."</div>";
	 	echo "<div>Πρόσβαση:".$view."</div>";

  }  
  echo "</div>";
  
 $query2 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE userName='$creator'" );
$info = mysql_fetch_array( $query2 ); 
		$k=$info['ID'];

$query1 = "INSERT INTO news (NewsTitle,NewsText,view,NewsDate,author_id)
             VALUES ('$name','$message','$view', CURDATE() ,'$k')";
  
  mysql_query($query1) or die('Δεν έγινε η αποστολή');



?>         
            
            
            