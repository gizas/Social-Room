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

<p><?php echo ("Έχετε συνδεθεί ως χρήστης <b>".$curUser)."</b>"?></p>
<p><form action="" method="POST">
<input type="hidden" name="action" value="logout">
<input type="submit" id="button" value="Logout">
</form></p>
	</div>
	
		<p>
					
			<?php	
//IDIOTIKES
				$query1 = mysql_query( "SELECT ID,userName FROM myuser WHERE userName='$curUser' " );
$info1 =mysql_fetch_array( $query1 ); 
					
				

	$query3 = mysql_query( "SELECT NewsTitle,NewsText,view,author_id,NewsDate FROM news WHERE author_id='$info1[ID]' AND (view='1' OR view='2') ORDER BY NewsDate Desc" );

//EMFANHS
	$query5 = mysql_query( "SELECT NewsTitle,NewsText,view,author_id,NewsDate FROM news WHERE  view='0' ORDER BY NewsDate Desc" );
	?>
	<b>Ανακοινώσεις</b> 
	<h3>Ιδιωτικές</h3>
		<hr/><hr/><hr/>
		
	<table width="100%" cellpadding="3" cellspacing="5" border="0">
		<tr bgcolor="#eeeeee">
		<?php
	
	echo "<td>";
	  		echo"Τίτλος";
	 		echo "</td>";
		 echo "<td>";
	  		echo"Κείμενο";
	 		echo "</td>";
		 	echo "<td>";
	  		echo"Ημερομηνία";
	 		echo "</td>";		
	  
	   ?> 
		</tr>
		<tr>
		<?php
while($info3 =mysql_fetch_array( $query3 )){
	
	echo "<tr>";
		echo "<td bgcolor='orange'>";
		  echo"$info3[NewsTitle]";
		 echo "</td>"; 	  
		  echo "<td>";
		  echo"$info3[NewsText]";
		 echo "</td>"; 	  
		echo "<td>";
		echo"$info3[NewsDate]";
		echo "</td>";
	 	
	 	echo "</tr>";
	 	}?>
		</tr>
		</table>
		<br/>
	
	<h3>Εμφανής Σε όλους</h3>
		<hr/><hr/><hr/>
		
	<table width="100%" cellpadding="3" cellspacing="5" border="0">
		<tr bgcolor="#eeeeee">
		<?php
	
	echo "<td>";
	  		echo"Τίτλος";
	 		echo "</td>";
		 echo "<td>";
	  		echo"Κείμενο";
	 		echo "</td>";
	 		echo "<td>";
	  		echo"Αποστολέας";
	 		echo "</td>";	
		 	echo "<td>";
	  		echo"Ημερομηνία";
	 		echo "</td>";		
	  
	   ?> 
		</tr>
		<tr>
		<?php
		   	
while($info4 =mysql_fetch_array( $query5 )){
	$queryin = mysql_query( "SELECT ID,userName FROM myuser WHERE ID='$info4[author_id]' LIMIT 1" );
$infoin =mysql_fetch_array( $queryin );
	echo "<tr>";
		echo "<td bgcolor='orange'>";
		  echo"$info4[NewsTitle]";
		 echo "</td>"; 	  
		  echo "<td>";
		  echo"$info4[NewsText]";
		 echo "</td>"; 	  
		echo "<td>";
		echo"$infoin[userName]";
		echo "</td>";
		echo "<td>";
		echo"$info4[NewsDate]";
		echo "</td>";
	 	
	 	echo "</tr>";
	 	}?>
		</tr>
		</table>						
		<br/>
		
				<h3>Από φίλους</h3>
		<hr/><hr/><hr/>
		
	<table width="100%" cellpadding="3" cellspacing="5" border="0">
		<tr bgcolor="#eeeeee">
		<?php
	
	echo "<td>";
	  		echo"Τίτλος";
	 		echo "</td>";
		 echo "<td>";
	  		echo"Κείμενο";
	 		echo "</td>";
		 		echo "<td>";
	  		echo"Συγγραφέας";
	 		echo "</td>";
		 	echo "<td>";
	  		echo"Ημερομηνία";
	 		echo "</td>";		
	  
	   ?> 
		</tr>
		<tr>
		<?php
		 $queryf = mysql_query( "SELECT ID,userName FROM myuser WHERE userName='$curUser' " );
$infof =mysql_fetch_array( $queryf ); 
					
					$queryft = mysql_query( "SELECT friend_id,user_id FROM user_friends WHERE user_id='$infof[ID]'" );
		   
while($infoprivate =mysql_fetch_array( $queryft )){
		$query0 = mysql_query( "SELECT NewsTitle,NewsText,view,NewsDate,author_id FROM news WHERE author_id='$infoprivate[friend_id]' AND view='2' ORDER BY NewsDate Desc" );
while($info0 =mysql_fetch_array( $query0 )){
	 $queryfinal = mysql_query( "SELECT ID,userName FROM myuser WHERE ID='$info0[author_id]' " );
$infofinal =mysql_fetch_array( $queryfinal ); 
	echo "<tr>";
		echo "<td bgcolor='orange'>";
		  echo"$info0[NewsTitle]";
		 echo "</td>"; 	  
		  echo "<td>";
		  echo"$info0[NewsText]";
		 echo "</td>";
		  
		echo "<td>";
		echo"$infofinal[userName]";
		echo "</td>";
		  	  		 
		echo "<td>";
		echo"$info0[NewsDate]";
		echo "</td>";
	 	
	 	echo "</tr>";
}}?>
		</tr>
		</table>						
	
					</p>				
				
	
			
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
							<a href="news.php">Υποβάλλετε Νέο</a>
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