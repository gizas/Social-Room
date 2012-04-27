<?php
	include("adminpro_class.php");
	?>
<html >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>My Book</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">My Book</a></h1>
			<h2><a href="http://localhost/askhsh">Βρείτε τις εικόνες σας</a></h2>
		</div>
		<!-- end div#logo -->
		<div id="menu">
			<ul>
				<li class="active"><a href="#">Αρχικη</a></li>
				<li><a href="viewgallery.php">Εικoνες</a></li>
		<li><a href="login.html">Login</a></li>
				<li>
	
	</li>
			<li>
					
					
				</li>	
			
			</ul>
		</div>
		<!-- end div#menu -->
	</div>
	<!-- end div#header -->
	<div id="page">
		<div id="content">
 <p><?php
 				
?>
			<div id="welcome">
				<h1>Καλώς Ήλθατε στον δικό σας χώρο!</h1>
				<p><strong>My Book!</strong> </p>
				<p> Βρίσκεστε στον δικό σας χώρο διασέδασης, το My Book, και μπορείτε να βρείτε φωτογραφίες σε μεγάλη ποι
	κιλία. Διασκεδάστε παίζοντας!

	           </p>
			</div>
			<!-- end div#welcome -->
			<div id="sample1" class="boxed">
				  

				<h2>Τι μπορείτε να κάνετε ...</h2>
				<ul>
					<li><a href="viewgallery.php">Περιηγηθείτε στις εικόνες μας</a></li>
					<li>Αποκτείστε δικαιώμτα ανεβάσματος εικόνων</li>
					<li><a href="#">Δείτε όμορφες συλλογές και άλμπουμ</a></li>
					
				</ul>
			</div>
			<!-- end div#sample1 -->
			<div id="sample2" class="boxed">
				<h2>Κάντε Login ...</h2>
				<p>Αποκτείστε κωδικό και ελάτε κοντά μας:</p>
				<ul>
					<li><a href="login.html">Βρείτε φίλους</a></li>
					<li><a href="login.html">Δημιουργήστε προσωπικές συλλογές φωτογραφιών</a></li>
					<li><a href="login.html">Δημιουργήστε το profil σας.  </a></li>
				</ul>
			</div>
			<!-- end div#sample2 -->
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<ul>
				<li id="submenu">
					<h2>Other Links</h2>
					<ul>
						<li><a href="first_page2.php">O Προσωπικός μου χώρος</a></li>
						<li><a href="upload.php">Ανεβάστε τις δικές σας Εικόνες</a></li>
						<li><a href="search.html">Αναζητείστε Χρήστη</a></li>
					</ul>
				</li>
				<!-- end li#submenu -->
				<li id="news">
					<h2>Τελευταίες Ανακοινώσεις</h2>
					<ul>
					<?php
					include 'config.inc.php';
					
						$query3 = mysql_query( "SELECT NewsTitle,NewsText,view,NewsDate FROM news WHERE view='0' ORDER BY NewsDate Desc LIMIT 4" );
while($info3 =mysql_fetch_array( $query3 )){
	
	echo "<li>";
	echo "<h3>";
		echo"$info3[NewsTitle]";echo":";echo"$info3[NewsDate]";
		 echo "</h3>"; 	  
		echo "<a>";
		 echo"$info3[NewsText]";
		 echo "</a>";
		 echo "</li>"; 	  
	
	 	}?>
			
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
