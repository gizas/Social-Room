<?php

include("adminpro_class.php");


$prot=new protect();
if ($prot->showPage) {
$curUser=$prot->getUser();
?>

<?php
	include("config.inc.php");

	// initialization
	$result_array = array();
	$counter = 0;

	$cid = (int)($_GET['cid']);
	$pid = (int)($_GET['pid']);

	// Category Listing

	if( empty($cid) && empty($pid) )
	{
		$number_of_categories_in_row = 2;
		
		$pp = mysql_query( "SELECT ID,userName
						FROM myuser WHERE userName='$curUser' ");
		$info = mysql_fetch_array( $pp ); 
		$k=$info['ID'];
		$result = mysql_query( "SELECT c.category_id,c.category_name,COUNT(photo_id),c.view, c.creator
						FROM gallery_category as c 
						LEFT JOIN gallery_photos as p ON p.photo_category = c.category_id WHERE c.creator='$k'
						GROUP BY c.category_id " );
		while( $row = mysql_fetch_array( $result ) )
		{
			$result_array[] = "<a href='viewgalleryp.php?cid=".$row[0]."'>".$row[1]."</a> "."(".$row[2].")";
		}
		mysql_free_result( $result );	

		$result_final = "<tr>\n";

		foreach($result_array as $category_link)
		{
			if($counter == $number_of_categories_in_row)
			{	
				$counter = 1;
				$result_final .= "\n</tr>\n<tr>\n";
			}
			else
			$counter++;

			$result_final .= "\t<td>".$category_link."</td>\n";
		}

		if($counter)
		{
			if($number_of_categories_in_row-$counter)
			$result_final .= "\t<td colspan='".($number_of_categories_in_row-$counter)."'>&nbsp;</td>\n";

			$result_final .= "</tr>";
		}
	}


	// Thumbnail Listing

	else if( $cid && empty( $pid ) )
	{
		$number_of_thumbs_in_row = 3;

		$result = mysql_query( "SELECT photo_id,photo_caption,photo_filename FROM gallery_photos WHERE photo_category='".addslashes($cid)."'" );
			
		$nr = mysql_num_rows( $result );

		if( empty( $nr ) )
		{
			$result_final = "\t<tr><td>Δεν βρέθηκαν φωτογραφίες</td></tr>\n";
		}
		else
		{
			while( $row = mysql_fetch_array( $result ) )
			{
				$result_array[] = "<a href='viewgalleryp.php?cid=$cid&pid=".$row[0]."'><img src='".$images_dir."/tb_".$row[2]."' border='0' alt='".$row[1]."' /></a>";
			}
			mysql_free_result( $result );	

			$result_final = "<tr>\n";
	
			foreach($result_array as $thumbnail_link)
			{
				if($counter == $number_of_thumbs_in_row)
				{	
					$counter = 1;
					$result_final .= "\n</tr>\n<tr>\n";
				}
				else
				$counter++;

				$result_final .= "\t<td>".$thumbnail_link."</td>\n";
			}
	
			if($counter)
			{
				if($number_of_photos_in_row-$counter)
			$result_final .= "\t<td colspan='".($number_of_photos_in_row-$counter)."'>&nbsp;</td>\n";

				$result_final .= "</tr>";
			}
		}
	}

	// Full Size View of Photo
	else if( $pid )
	{
		$result = mysql_query( "SELECT photo_caption,photo_filename FROM gallery_photos WHERE photo_id='".addslashes($pid)."'" );
		list($photo_caption, $photo_filename) = mysql_fetch_array( $result );
		$nr = mysql_num_rows( $result );
		mysql_free_result( $result );	

		if( empty( $nr ) )
		{
			$result_final = "\t<tr><td>No Photo found</td></tr>\n";
		}
		else
		{
			$result = mysql_query( "SELECT category_name FROM gallery_category WHERE category_id='".addslashes($cid)."'" );
			list($category_name) = mysql_fetch_array( $result );
			mysql_free_result( $result );	

			$result_final .= "<tr>\n\t<td>
						<a href='viewgalleryp.php'>Categories</a> &gt; 
						<a href='viewgalleryp.php?cid=$cid'>$category_name</a></td>\n</tr>\n";

			$result_final .= "<tr>\n\t<td align='center'>
					<br />
					<img src='".$images_dir."/".$photo_filename."' border='0' alt='".$photo_caption."' width='300px' height='300px'/>
					<br />
					$photo_caption
					</td>
					</tr>";
		}
	}

// Final Output
echo <<<__HTML_END
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
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
	
	
	<table width='100%' border='0' align='center' style='width: 100%;'>
$result_final		
</table>
	
	
		</div>
			
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<ul>
				<li id="submenu">
					<h2>Other Links</h2>
					<ul>
				     		<li><a href='first_page2.php'>H προσωπική μου σελίδα</a>;
  							</li>
  						   <li> <a href='profil.php'>Το προφίλ μου</a></li>
					<li>	<a href='viewgalleryp.php'>Οι Εικόνες μου</a>
								<ul><li><a href='creategal.php'>Δημιουργία Άλμπουμ</a></li></ul>
					</li>
						
						<li><a href='friends.php'>Οι Φίλοι</a></li>
					</ul>
				</li>
				<!-- end li#submenu -->
				<li id="news">
					<h2>News</h2>
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
__
	</body>
</html>
						   
__HTML_END;
?>
	<?php
}
?>