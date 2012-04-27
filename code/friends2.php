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
			<h1><a href="http://localhost/askhsh">My Book</a></h1>
			<h2><a href="">Βρείτε τις εικόνες σας</a></h2>
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

					<p>
					
<?php	include 'config.inc.php';
$nameid  = $_POST['name'];	
$fname   = $_POST['fname'];	
echo "<p><i>Οι φίλοι του χρήστη</i>&nbsp;";
echo "<b>$fname</b></p>";

					
					$query2 = mysql_query( "SELECT friend_id,user_id FROM user_friends WHERE user_id='$nameid'" );
while($info2 =mysql_fetch_array( $query2 )){ 
		
										
	?>
		 <br/>
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
		{$query3 = mysql_query( "SELECT name,surname,icon,my_id,email,available FROM user_info WHERE my_id='$info2[friend_id]'" );

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
}?>
		</tr>
		</table>
	
					</p>				
				
					
						
					
	</div>
			
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<ul>
				<li id="submenu">
					<h2>Links</h2>
					<ul>
					<li>
			<A HREF="javascript:history.go(-1)">Επιστροφή</A> 
			</li>
					</ul>
				</li>
				<!-- end li#submenu -->
			
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

