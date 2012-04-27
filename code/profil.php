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
     
	new Protoform('test');     
	  
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
<p><i>Εδώ μπορείτε να διαμορφώσετε το δικό σας προφίλ...</i></p>
<p><?php echo ("Έχετε συνδεθεί ως χρήστης <b>".$curUser)."</b>"?></p>
<p><form action="" method="POST">
<input type="hidden" name="action" value="logout">
<input type="submit" id="button" value="Logout">
</form></p>
					<p>
					
			<?php	
					$query2 = mysql_query( "SELECT name,surname,email,telephone,icon FROM user_info WHERE email='$curUser'" );
$info = $info=mysql_fetch_array( $query2 ); 
			
			?>
	<table width="60%" border="0" cellpading="5">     
				<tr >
				<td>
				<?php if($info[icon]==null)
				echo "<img src='users/user.jpg' width='60px' height='60px'/>";
			    else{
				echo "<img src='users/"; echo "$info[icon]' width='60px' height='60px'/?>"; 
				}?>
				</td>
				<td><b>Όνομα:&nbsp;</b><?php 
					if($info[name]==null)
					echo "Δεν έχει οριστεί";
					else{
				echo "$info[name]"; 
				}?>
				</td>
				</tr>
				<tr><td/><b>Επίθετο:</b> <td><?php 
					if($info[surname]==null)
					echo "Δεν έχει οριστεί";
					else{
				echo "$info[surname]"; 
				}?></td></tr> 
				<tr><td/><b>Email:</b><td><?php 
					if($info[email]==null)
					echo "Δεν έχει οριστεί";
					else{
				echo "$info[email]"; 
				}?></td></tr>
				<tr><td/><b>Τηλέφωνο:</b><td><?php 
					if($info[telephone]==null)
					echo "Δεν έχει οριστεί";
					else{
				echo "$info[telephone]"; 
				}?></td></tr>
				</tr>
				
				</table>				
					
					</p>				
				
						<p>Αλλαγή της εικόνας σας ...
						<form method="post" enctype="multipart/form-data" action="uploadone.php">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr>
<td width="246">
<label for="file">Filename:</label>
<input type="file" name="uploaded" id="file" />
<br /></td>
<td width="80"><input name="upload" type="submit"  value=" Upload "></td>
</tr>
</table>
</form>
						</p>
							<form action="sendmail.php" method="post" id="test" border="0">
			<fieldset>Να φαίνεται το email μου;
				
				<div>
					<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr>
				<td width="246">		<input type="hidden" value="<?php echo $curUser; ?>" name="user"/>
					<input type="radio" value="0" name="available" title="Να φαίνεται το email μου ..." />Όχι
					<input type="radio" value="1" name="available" title="Να φαίνεται το email μου ..." />Ναι</td>
				<td width="80"><input type="submit" value="Αποστολή" /></td></tr>
        	</table>
				</div>
				
			</fieldset>
		</form>
					
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