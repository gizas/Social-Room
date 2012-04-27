<?php

include("adminpro_class.php");


$prot=new protect();
if ($prot->showPage) {
$curUser=$prot->getUser();
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>My Book</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</style>
	<script src="js/prototype.js" type="text/javascript"></script>
<script src="protoformclass.js" type="text/javascript"></script>
<script type="text/javascript">
Event.observe(window,"load",function() {
     
	new Protoform('tests');     
	  
});
</script>	
<script type="text/javascript">
Event.observe(window,"load",function() {
     
	new Protoform('testr');     
	  
});
</script>	

</head>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">My Book</a></h1>
			<h2><a href="http://localhost/askhsh">Βρείτε τις εικόνες σας</a></h2>
		</div>
		<!-- end div#logo -->
		<div id="menu">
			<ul>
				<li class="active"><a href="index.php">Αρχικη</a></li>
				<li><a href="viewgallery.php">Εικoνες</a></li>
				
				<li><a href="#"></a></li>
			</ul>
		</div>
		<!-- end div#menu -->
	</div>
	<!-- end div#header -->
	<div id="page">
		<div id="content">
			<div id="welcome">
<p><i>Αυτή είναι η προσωπική σας σελίδα</i></p>

<p><?php 
	include 'config.inc.php';
	echo ("Έχετε συνδεθεί ως χρήστης <b>".$curUser)."</b>"?></p>
<p><form action="" method="POST">
<input type="hidden" name="action" value="logout">
<input type="submit" id="button" value="Logout">
</form></p>
	</div>
<?php 
		$query2 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE userName='$curUser'" );
$info = mysql_fetch_array( $query2 ); 
		$k=$info['ID'];
		
		$query1 = mysql_query("SELECT id,message,from_id,to_id FROM notifications WHERE to_id='$k'");
 
  	  while($row = mysql_fetch_array($query1)){
$query3 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE ID='$row[from_id]'" );
$info2 = mysql_fetch_array( $query3 );  	  	 
  	  	 echo "<table border='0' width='100%'>";
  	  	 echo "<tr>";
  	  	 echo "<td bgcolor='#ffcc66' colspan='2'>";
  	  	 echo "<b>Έχετε μια :</b><br/>";
  	  	 echo "<h4>$row[message]</h4>";
  	  	 echo "από τον χρήστη με όνομα:";
     	 echo "&nbsp;<b><i>$info2[userName]</i>";
  	  	 echo "</b>";
  	  	 echo "</td>";
  	  	 echo "</tr>";
  	  	 echo "<tr>";
  	  	 echo "<td>";
  	  	 echo "Τι επιθυμείτε;";
  	  	 echo "</td>";
  	  	 echo "</tr>";
  	  	 echo "<tr>";
  	  	 echo "<td>";
  	  	 echo "<form action='notifys.php' method='post' id='tests'>
						
					<input type='hidden' id='name_Req' name='from' value='$row[from_id]'/>
					<input type='hidden' id='name2_Req' name='to' value='$row[to_id]'/>
				    <input type='hidden' id='name2_Req' name='id' value='$row[id]'/>
				    
				    <div><br/>
					<label for='message'>Σχόλια για τον φίλο σας<span></span></label><br/>
					<textarea id='message' name='message' rows='1' cols='25'></textarea><br/>
				</div>
					<div class='button'><br/><br/>
					<input type='submit' value='Αποδοχή' id='submit'/>
        		</div>
				
			</form>		
				";
  	  	 echo "</td>";
  	  	 echo "<td border='0'>";
  	  	 echo "<form action='notifyr.php' method='post' id='testr'>
				
					<input type='hidden' id='name_Req' name='name' value='$row[id]' />
									
					<div class='button'><br/><br/><br/><br/><br/><br/><br/>
					<input type='submit' value='Διαγραφή' id='reject'/>
        		</div>
			
			</form>		
				";
  	  	 echo "</td>";
  	  	   	  	 echo "<hr color='#cc0000'/>";

  	  	 echo "<tr>";
  	  	 
  	  	 
  	  	 echo "</tr>";
  	  	 echo "</table>";
  	  }
  	  
  	  ?>


			
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<ul>
				<li id="submenu">
					<h2>Other Links</h2>
					<ul>
						<?php		if ($curUser=="admin"){
						$out.="<li>";	
						 $out.="<a href='adminuser.php'>Μενού Διαχειριστή</a>";
						 $out.="<br/>";
						 $out.="</li>";
						 	$out.="<li>";	
  							$out.="<a href='first_page2.php'>H προσωπική μου σελίδα</a>";
  							$out.="</li>";
 						$out.="<li>";
 						 $out.="<a href='viewgalleryp.php'>Οι Εικόνες μου</a>";
 						 $out.="</li>";
 						 $out.="<li>";
 						 $out.="<a href='friends.php'>Οι Φίλοι μου</a>";
 						 $out.="</li>";
 						 $out.="<li>";
 						 $out.="<a href='creategal.php'>Δημιουργία Άλμπουμ </a>";
 						 $out.="</li>";
 						 	$out.="<li>";	
  							$out.="<a href='search.html'>Αναζήτηση Χρήστη</a>";
  							$out.="</li>";
 						 echo $out;
  							}
  							else{
  								$out.="<li>";	
  							$out.="<a href='first_page2.php'>H προσωπική μου σελίδα</a>";
  							$out.="</li>";
  								$out.="<li>";	
  							$out.="<a href='profil.php'>Το προφίλ μου</a>";
  							$out.="</li>";
  							$out.="<li>";	
  							$out.="<a href='friends.php'>Οι Φίλοι</a>";
  							$out.="</li>";
  							$out.="<li>";
  							$out.="<br\>";
 						 $out.="<a href='viewgalleryp.php'>Οι Εικόνες μου</a>";
					        $out.="</li>";
					         $out.="<li>";
 						 $out.="<a href='creategal.php'>Δημιουργία Άλμπουμ </a>";
 						 $out.="</li>";
 						 	$out.="<li>";	
  							$out.="<a href='search.html'>Αναζήτηση Χρήστη</a>";
  							$out.="</li>";
					echo $out;}
					?></li>
					</ul>
				</li>
				<!-- end li#submenu -->
				<li id="news">
					<h2>Λειτουργίες</h2>
					<ul>
						<li>
						<a href='viewnews.php'>Ανακοινώσεις </a>
						</li>
						
						<li>
						<p><form action="" method="POST">
<input type="hidden" name="action" value="logout">
<input type="submit" id="button" value="Logout">
</form></p>

	
	
		               </li>
		               	   
					
					</ul>
				</li>
				<!-- end li#news -->
			</ul>
		</div>
		<!-- end div#sidebar -->
		<div style="clear: both; height: 1px"></div>
	</div>
	<!-- end div#page -->
	<div id="footer">
		<p id="legal"></p>
		<p id="links"><a href="#"></p>
	</div>
	<!-- end div#footer -->
</div>
<!-- end div#wrapper -->
</body>
</html>


<?php
}
?>