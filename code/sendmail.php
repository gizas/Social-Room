<?php
	
   include 'config.inc.php';

	echo "<div id=\"response\">";


  $name            = $_POST['available'];
  $user            = $_POST['user'];
 
  
  if ( ($name=='')) { 
  
  		echo "<p><span>*Missing Fields</span></em></p>";
  	
  }
  else {
  
	 	echo "<p>Επιτυχής αποστολή!</p>";
		if($name==1)
		{echo "Εμφανές το email σας για όλους";}
	    else
	    {echo "Κρυφό email";}
		echo "</ul>";
  }  
  echo "</div>";
  
 
$query = "UPDATE user_info SET available='$name' WHERE email='$user'";
  
  mysql_query($query) or die('Error3, query failed');
  	  
  	  ?>         
            
            
            