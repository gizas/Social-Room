<?php
	include("config.inc.php");

	// initialization
	$result_final = "";
	$counter = 0;

	// List of our known photo types
	$known_photo_types = array( 
						'image/pjpeg' => 'jpg',
						'image/jpeg' => 'jpg',
						'image/gif' => 'gif',
						'image/bmp' => 'bmp',
						'image/x-png' => 'png'
					);
	
	// GD Function List
	$gd_function_suffix = array( 
						'image/pjpeg' => 'JPEG',
						'image/jpeg' => 'JPEG',
						'image/gif' => 'GIF',
						'image/bmp' => 'WBMP',
						'image/x-png' => 'PNG'
					);

	// Fetch the photo array sent by preupload.php
	$photos_uploaded = $_FILES['photo_filename'];

	// Fetch the photo caption array
	$photo_caption = $_POST['photo_caption'];

	while( $counter <= count($photos_uploaded) )
	{
		if($photos_uploaded['size'][$counter] > 0)
		{
			if(!array_key_exists($photos_uploaded['type'][$counter], $known_photo_types))
			{
				$result_final .= "File ".($counter+1)." is not a photo<br />";
			}
			else
			{
				mysql_query( "INSERT INTO gallery_photos(`photo_filename`, `photo_caption`, `photo_category`) VALUES('0', '".addslashes($photo_caption[$counter])."', '".addslashes($_POST['category'])."')" );
				$new_id = mysql_insert_id();
				$filetype = $photos_uploaded['type'][$counter];
				$extention = $known_photo_types[$filetype];
				$filename = $new_id.".".$extention;

				mysql_query( "UPDATE gallery_photos SET photo_filename='".addslashes($filename)."' WHERE photo_id='".addslashes($new_id)."'" );

				// Store the orignal file
				copy($photos_uploaded['tmp_name'][$counter], $images_dir."/".$filename);

				// Let's get the Thumbnail size
				$size = GetImageSize( $images_dir."/".$filename );
				if($size[0] > $size[1])
				{
					$thumbnail_width = 100;
					$thumbnail_height = (int)(100 * $size[1] / $size[0]);
				}
				else
				{
					$thumbnail_width = (int)(100 * $size[0] / $size[1]);
					$thumbnail_height = 100;
				}
			
				// Build Thumbnail with GD 1.x.x, you can use the other described methods too
				$function_suffix = $gd_function_suffix[$filetype];
				$function_to_read = "ImageCreateFrom".$function_suffix;
				$function_to_write = "Image".$function_suffix;

				// Read the source file
				$source_handle = $function_to_read ( $images_dir."/".$filename ); 
				
				if($source_handle)
				{
					// Let's create an blank image for the thumbnail
				     	$destination_handle = ImageCreate ( $thumbnail_width, $thumbnail_height );
				
					// Now we resize it
			      	ImageCopyResized( $destination_handle, $source_handle, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $size[0], $size[1] );
				}

				// Let's save the thumbnail
				$function_to_write( $destination_handle, $images_dir."/tb_".$filename );
				ImageDestroy($destination_handle );
				//

				$result_final .= "<img src='".$images_dir. "/tb_".$filename."' /> File ".($counter+1)." Added<br />";
			}
		}
	$counter++;
	}

	// Print Result
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
	$result_final
	</div>
			
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<ul>
				<li id="submenu">
					<h2>Other Links</h2>
					<ul>
						<li><a href="first_page2.php">O Προσωπικός μου χώρος</a></li>
						<li><a href="viewgalleryp.php">Ανεβάστε τις δικές σας Εικόνες</a></li>
					</ul>
				</li>
				<!-- end li#submenu -->
				<li id="news">
					<h2>News &amp; Updates</h2>
					<ul>	<li>
						<a href='viewnews.php'>Ανακοινώσεις </a>
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

__HTML_END;
?>
