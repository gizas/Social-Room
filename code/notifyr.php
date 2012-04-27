<?php
	
   include 'config.inc.php';

	echo "<div id=\"response\">";


  $from            = $_POST['name'];
  
  if ( ($from=='')) { 
  
  		echo "<p><span>Δεν έγινε δεκτό το αίτημά σας!</span></em></p>";
  	
  }
  else {
  
	 	echo "<p>Διαγραφή!</p>";
		}  
  echo "</div>";
  

$query1 = "DELETE FROM notifications
WHERE id = '$from'";
  
  mysql_query($query1) or die('Error, query failed');
?>         
            
            
            