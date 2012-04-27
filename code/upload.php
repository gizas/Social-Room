<?php

include("adminpro_class.php");



$prot=new protect("1","2","3","4","5");
if ($prot->showPage) {
$curUser=$prot->getUser();
?>

<?php
	include("config.inc.php");

	// initialization
	$photo_upload_fields = "";
	$counter = 1;

	// default number of fields
	$number_of_fields = 5; 

// If you want more fields, then the call to this page should be like, 
// preupload.php?number_of_fields=20

	if( $_GET['number_of_fields'] )
	$number_of_fields = (int)($_GET['number_of_fields']);

	// Firstly Lets build the Category List

	$result = mysql_query( "SELECT category_id,category_name FROM gallery_category" );
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
<html>
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
				<li class="active"><a href="index.php">Αρχικη</a></li>
				<li><a href="viewgallery.php">Εικoνες</a></li>
				<li><a href="login.html">Login</a></li>
				<li><a href="#"></a></li>
			</ul>
		</div>
		<!-- end div#menu -->
	</div>
	<!-- end div#header -->
	<div id="page">
		<div id="content">
			<div id="welcome">	
<form enctype='multipart/form-data' action='upload_photos.php' method='post' name='upload_form'>
<table width='90%' border='0' align='center' style='width: 90%;'>
<tr>
	<td>
		Select Category
		<select name='category'>
			$photo_category_list
		</select>
	</td>
</tr>
<tr>
	<td>
		<p>&nbsp;</p>
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
</div>
			
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<ul>
				<li id="submenu">
					<h2>Other Links</h2>
					<ul>
						<li><a href="#">Semper vestibulum</a></li>
						<li><a href="#">Vestibulum luctus</a></li>
						<li><a href="#">Integer rutrum</a></li>
						<li><a href="#">Etiam malesuada</a></li>
						<li><a href="#">Elementum facilisis</a></li>
						<li><a href="#">Ut tincidunt</a></li>
						<li><a href="#">Odio sagittis</a></li>
					</ul>
				</li>
				<!-- end li#submenu -->
				<li id="news">
					<h2>News &amp; Updates</h2>
					<ul>
						<li>
							<h3>10th May</h3>
							<p><a href="#">Pellentesque quis elit non lectus gravida blandit&hellip;</a></p>
						</li>
						<li>
							<h3>23rd April</h3>
							<p><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing&hellip;</a></p>
						</li>
						<li>
							<h3>21st April</h3>
							<p><a href="#">Phasellus nec erat sit amet nibh pellentesque congue&hellip;</a></p>
						</li>
						<li>
							<h3>17th April </h3>
							<p><a href="#">Maecenas vitae orci vitae tellus feugiat eleifend&hellip;</a></p>
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
</body>
</html>
__HTML_END;
?>
<?php
}
?>