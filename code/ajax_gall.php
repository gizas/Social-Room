<?php
	
   include 'config.inc.php';

	echo "<div id=\"response\">";


  $name            = $_POST['name'];
  $view           = $_POST['view'];
  $creator       = $_POST['creator'];
  
  
  if ( ($name=='') && ($view=='')&& ($creator=='')) { 
  
  		echo "<p><span>*Ελλειπής Συμπλήρωση</span></em></p>";
  	
  }
  else {
  
	 	echo "<p>Επιτυχης αποστολή!</p>";
		echo "<ul>";
		echo "<li>Όνομα: ".$name."</li>";
	 	echo "<li>Πρόσβαση: ".$view."</li>";
	 	echo "<li>Δημιουργός:".$creator."</li>";
	 		echo "</ul>";
  }  
  echo "</div>";
  
 
$query2 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE userName='$creator'" );
$info = mysql_fetch_array( $query2 ); 
		$k=$info['ID'];

$query = mysql_query( "INSERT INTO gallery_category (category_name,view,creator) VALUES ('$name', '$view','$k')" );
 

?>         
            
            
            