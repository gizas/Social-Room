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
     
	new Protoform('test');     
	  
});
</script>	
</head>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="index.php">My Book</a></h1>
			<h2><a href="#">Βρείτε τις εικόνες σας</a></h2>
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
					<h1>Ανεβάστε το δικό σας αλμπουμ</h1>

<p><?php echo ("Έχετε συνδεθεί ως χρήστης <b>".$curUser)."</b>"?></p>
<p><form action="" method="POST">
<input type="hidden" name="action" value="logout">
<input type="submit" id="button" value="Logout">
</form></p>
	<p>
	</div>
	
		<b>Δημιουργία Κατηγορίας</b>
		<form action="ajax_gall.php" method="post" id="test">
			<table width="100%" cellpadding="5" border="0"> 
				<tr>
				<td>
					<label for="name_Req">Όνομα Κατηγορίας<span>*</span></label>
					<input type="text" id="name_Req" name="name" title="Required! Όνομα" />
				</td></tr>
					<tr><td>
					<label for="message_Req">Δικαιώματα<span>*</span></label>
					<SELECT NAME="view" title="Required! Εισάγετε δικαιώματα"/>
					<OPTION VALUE="0">Ελεύθερο
					<OPTION VALUE="1">Ιδιωτικό
					<OPTION VALUE="2">Φίλοι
					</SELECT>
				</td></tr>
				<tr><td>
					<input type="hidden" id="user" name="creator" value="<?php echo $curUser; ?>" title="Required! Εισάγετε σωστή email address" />
				</td><tr>
				
			<tr><td>
				<div class="button">
					<input type="submit" value="Αποστολή" />
        		</div></td>
        		</tr>
			</table>
		</form><br/>
	
	
	<?php
	include("config.inc.php");

	// initialization
	$photo_upload_fields = "";
	$counter = 1;

	// default number of fields
	$number_of_fields = 1; 



	if( $_GET['number_of_fields'] )
	$number_of_fields = (int)($_GET['number_of_fields']);

	// Firstly Lets build the Category List
    
  	$query2 = mysql_query( "SELECT ID,userName FROM myuser WHERE userName='$curUser'" );
$info = mysql_fetch_array( $query2 ); 
		$k=$info['ID'];

	$result = mysql_query( "SELECT category_id,category_name FROM gallery_category WHERE creator='$k'" );
	while( $row = mysql_fetch_array( $result ) )
	{
$photo_category_list .=<<<__HTML_END
	<option value="$row[0]">$row[1]</option>\n
__HTML_END;
	}
	mysql_free_result( $result );	

// Lets build the Photo Uploading fields
	while( $counter <= $number_of_fields )
	{
$photo_upload_fields .=<<<__HTML_END
<tr>
	<td>
	     Photo {$counter}:
	    <input name=' photo_filename[]' type='file' />
	</td>
</tr>
<tr>
	<td>
	     Caption:
	    <textarea name='photo_caption[]' cols='30' rows='1'></textarea>
	</td>
</tr>
__HTML_END;
	$counter++;
	}

// Final Output
echo <<<__HTML_END

<form enctype='multipart/form-data' action='upload_photos.php' method='post' name='upload_form'>
<table width='90%' border='0' align='center' style='width: 90%;'>
<tr>
	<td>
		Επιλογή Κατηγορίας
		<select name='category'>
			$photo_category_list
		</select>
	</td>
</tr>


<!-Insert the photo fields here -->
$photo_upload_fields

<tr>
	<td>
	        <input type='submit' name='submit' value='Add Photos' />
	</td>
</tr>
</table>
</form>

			
	
__HTML_END;
?>
	
	
	<br/>

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
 						 $out.="<a href='upload.php'>Ανέβασμα Εικόνων </a>";
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
					echo $out;}
					?></li>
					</ul>
				</li>
				<!-- end li#submenu -->
				<li id="news">
					<h2>Λειτουργίες</h2>
					<ul>
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