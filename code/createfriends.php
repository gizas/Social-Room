<?php

include("adminpro_class.php");
include 'config.inc.php';


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
				<li><a href="#">Εικoνες</a></li>
				
				<li><a href="#"></a></li>
			</ul>
		</div>
		<!-- end div#menu -->
	</div>
	<!-- end div#header -->
	<div id="page">
		<div id="content">
			<div id="welcome">
<p><i>Κάντε Νέους Φίλους</i></p>

<p><?php echo ("Έχετε συνδεθεί ως χρήστης <b>".$curUser)."</b>"?></p>
<p><form action="" method="POST">
<input type="hidden" name="action" value="logout">
<input type="submit" id="button" value="Logout">
</form></p>
					<p>
					
			<?php	
				$query1 = mysql_query( "SELECT ID,userName FROM myuser WHERE userName='$curUser' " );
$info1 =mysql_fetch_array( $query1 ); 
					
					$query2 = mysql_query( "SELECT friend_id,user_id FROM user_friends WHERE user_id='$info1[ID]'" );
$info2 =mysql_fetch_array( $query2 ); 

	$query3 = mysql_query( "SELECT name,surname,icon,my_id,email,available FROM user_info WHERE my_id='$info2[friend_id]'" );
	?>
	<b>Οι φίλοι μου</b> <br/>
	<table width="100%" cellpadding="5" border="0">
		<tr bgcolor="#eeeeee">
	
		<?php
	
	
	echo "<tr>";		
		 if ($info2[friend_id]!=Null)
	   {echo "<td>";
	  		echo"Όνομα";
	 		echo "</td>";
		 echo "<td>";
	  		echo"Επίθετο";
	 		echo "</td>";
		 echo "<td>";
	  		echo"Email";
	 		echo "</td>"; 
	 		echo "<td>";
	  		echo"Εικόνα";
	 		echo "</td>";		
	   }?> 
		</tr>
		<tr>
		<?php
		
		 if ($info2[friend_id]!=Null)
		{
		 	while($info3 =mysql_fetch_array( $query3 )){
		 echo "<td>";
		  echo"$info3[name]";
		 echo "</td>"; 	  
		  echo "<td>";
		  echo"$info3[surname]";
		 echo "</td>"; 	  
		if($info3[available]=='1')
			{echo "<td>";
	  		echo"$info3[email]";
	 		echo "</td>";}
	 	 else
	 	 {	echo "<td>";	 
	 	 	echo"Κρυφό Email";
	 	 	echo "</td>";}
	 		echo "<td>";	
	 		echo "<img src='users/";
	 		echo "$info3[icon]";
	 		echo "'";
	 		echo "&nbsp;";
	 		echo "width='60px' height='60px'/>";
	 		echo "</td>";
	 	 }}else
	 	 {echo "<i>Δεν βρέθηκαν φίλοι</i>";}
		 ?>
		</tr>
		</table><br/>
		Προσθέστε το όνομα ή το email του φίλου που επιθυμείτε....<hr/><br/>
			  <form action='addf.php' method='post' id='tests'>
						
					<input type='hidden' id='name_Req' name='from' value='<?php echo"$curUser";?>'/>
					 <div><br/>
					<label for='message'>Email ή κωδικό όνομα χρήστη<span></span></label><br/>
					<textarea id='message2' name='message2' rows='1' cols='25'></textarea><br/>
					
					<label for='message'>Όνομα<span></span></label><br/>
					<textarea id='message1' name='message1' rows='1' cols='25'></textarea><br/>
		            	
					</div>
					<div class='button'><br/><br/>
					<input type='submit' value='Αποστολή' id='submit'/>
        		</div>
				
			</form>		
								
		
	
					</p>				
				
					
						
					
	</div>
			
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
  							$out.="<a href='first_page2.php'>Η προσωπική μου σελίδα</a>";
  							$out.="</li>";
 						$out.="<li>";
 						 $out.="<a href='viewgalleryp.php'>Οι Εικόνες μου</a>";
 						 $out.="</li>";
 						 $out.="<li>";
 						 $out.="<a href='friends.php'>Οι Φίλοι μου</a>";
 						 	$out.="<ul>";
 						 	$out.="<li class='active'>";	
  							$out.="<a href='createfriends.php'>Προσθήκη Φίλων</a>";
  							$out.="</li>";
  							$out.="</ul>";
 						 $out.="</li>";
 						 echo $out;
  							}
  							else{
  							$out.="<li>";	
  							$out.="<a href='first_page2.php'>Η προσωπική μου σελίδα</a>";
  							$out.="</li>";
  								$out.="<li>";	
  							$out.="<a href='profil.php'>Το προφίλ μου</a>";
  							$out.="</li>";
  							$out.="<li>";	
  							$out.="<a href='friends.php'>Οι Φίλοι</a>";
  								$out.="<ul>";
  								$out.="<li>";	
  							$out.="<a href='createfriends.php'>Κάντε φίλους</a>";
  							$out.="</li>";
  								$out.="</ul>";
  							$out.="</li>";
  							$out.="<li>";
  							$out.="<br\>";
 						 $out.="<a href='viewgalleryp.php'>Οι Εικόνες μου</a>";
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