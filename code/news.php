<?php

include("adminpro_class.php");
include 'config.inc.php';


$prot=new protect();
if ($prot->showPage) {
$curUser=$prot->getUser();
?>
<html >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>My Book</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script src="js/prototype.js" type="text/javascript"></script>
<script src="protoformclass.js" type="text/javascript"></script>
<script type="text/javascript">
Event.observe(window,"load",function() {
     
	new Protoform('test');     
	  
});
</script>	
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">My Book</a></h1>
			<h2><a href="http://localhost/askhsh">&#914;&#961;&#949;&#943;&#964;&#949; &#964;&#953;&#962; &#949;&#953;&#954;&#972;&#957;&#949;&#962; &#963;&#945;&#962;</a></h2>
		</div>
		<!-- end div#logo -->
		<div id="menu">
			<ul>
				<li><a href="index.php">&#913;&#961;&#967;&#953;&#954;&#951;</a></li>
				<li><a href="viewgallery.php">&#917;&#953;&#954;o&#957;&#949;&#962;</a></li>
				
			</ul>
		</div>
		<!-- end div#menu -->
	</div>
	<!-- end div#header -->
	<div id="page">
		<div id="content">
			
				<center>
<h1> &#917;&#953;&#963;&#940;&#947;&#949;&#964;&#949; &#957;&#941;&#959;</h1>
<p>
&#917;&#953;&#963;&#940;&#947;&#949;&#964;&#945;&#953; &#972;&#957;&#959;&#956;&#945; &#967;&#961;&#942;&#963;&#964;&#951; &#954;&#945;&#953; &#954;&#969;&#948;&#953;&#954;&#972; &#954;&#945;&#953; &#949;&#953;&#963;&#941;&#955;&#952;&#949;&#964;&#949; &#963;&#964;&#959;&#957; &#953;&#963;&#964;&#972;&#964;&#959;&#960;&#972; &#956;&#945;&#962;, &#969;&#962; &#967;&#961;&#942;&#963;&#964;&#949;&#962;.
</p>

		<form action="news_send.php" method="post" id="test">
			<fieldset>
				
				<div>
					<label for="name_Req">&#932;&#943;&#964;&#955;&#959;&#962;<span>*</span></label>
					<input type="text" id="name_Req" name="name" title="Required! &#908;&#957;&#959;&#956;&#945;" />
				</div>
					<div><br/>
					<label for="message_Req">&#922;&#949;&#943;&#956;&#949;&#957;&#959;<span>*</span></label>
					<textarea id="message_Req" name="message" rows="5" cols="35" title="Required! &#917;&#953;&#963;&#940;&#947;&#949;&#964;&#949; &#964;&#959; &#954;&#949;&#943;&#956;&#949;&#957;&#972; &#963;&#945;&#962;"></textarea>
				</div>
					<input type="hidden" id="user" name="creator" value="<?php echo $curUser; ?>" title="Required! &#917;&#953;&#963;&#940;&#947;&#949;&#964;&#949; &#972;&#957;&#959;&#956;&#945; &#967;&#961;&#942;&#963;&#964;&#951;" />
					<div><br/>
					<label for="message_Req">&#928;&#961;&#972;&#963;&#946;&#945;&#963;&#951;<span>*</span></label>
					<SELECT NAME="view" title="Required! &#917;&#953;&#963;&#940;&#947;&#949;&#964;&#949; &#948;&#953;&#954;&#945;&#953;&#974;&#956;&#945;&#964;&#945;"/>
					<OPTION VALUE="0">&#917;&#955;&#949;&#973;&#952;&#949;&#961;&#959;
					<OPTION VALUE="1">&#921;&#948;&#953;&#969;&#964;&#953;&#954;&#972;
					<OPTION VALUE="2">&#934;&#943;&#955;&#959;&#953;
					</SELECT>
					</div>
				
				<div class="button">
					<input type="submit" value="&#933;&#960;&#959;&#946;&#959;&#955;&#942;" />
        		</div>
			</fieldset>
		</form>
	
	
			
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<ul>
				<li id="submenu">
					<h2>Other Links</h2>
					<ul>
						<?php		if ($curUser=="admin"){
						$out.="<li>";	
						 $out.="<a href='adminuser.php'>&#924;&#949;&#957;&#959;&#973; &#916;&#953;&#945;&#967;&#949;&#953;&#961;&#953;&#963;&#964;&#942;</a>";
						 $out.="<br/>";
						 $out.="</li>";
 						$out.="<li>";
 						 $out.="<a href='viewgalleryp.php'>&#927;&#953; &#917;&#953;&#954;&#972;&#957;&#949;&#962; &#956;&#959;&#965;</a>";
 						 $out.="</li>";
 						 $out.="<li>";
 						 $out.="<a href='friends.php'>&#927;&#953; &#934;&#943;&#955;&#959;&#953; &#956;&#959;&#965;</a>";
 						 $out.="</li>";
 						 $out.="<li>";
 						 $out.="<a href='creategal.php'>&#916;&#951;&#956;&#953;&#959;&#965;&#961;&#947;&#943;&#945; &#902;&#955;&#956;&#960;&#959;&#965;&#956; </a>";
 						 $out.="</li>";
 						 	$out.="<li>";	
  							$out.="<a href='search.html'>&#913;&#957;&#945;&#950;&#942;&#964;&#951;&#963;&#951; &#935;&#961;&#942;&#963;&#964;&#951;</a>";
  							$out.="</li>";
 						 echo $out;
  							}
  							else{
  								$out.="<li>";	
  							$out.="<a href='profil.php'>&#932;&#959; &#960;&#961;&#959;&#966;&#943;&#955; &#956;&#959;&#965;</a>";
  							$out.="</li>";
  							$out.="<li>";	
  							$out.="<a href='friends.php'>&#927;&#953; &#934;&#943;&#955;&#959;&#953;</a>";
  							$out.="</li>";
  							$out.="<li>";
  							$out.="<br\>";
 						 $out.="<a href='viewgalleryp.php'>&#927;&#953; &#917;&#953;&#954;&#972;&#957;&#949;&#962; &#956;&#959;&#965;</a>";
					        $out.="</li>";
					         $out.="<li>";
 						 $out.="<a href='creategal.php'>&#916;&#951;&#956;&#953;&#959;&#965;&#961;&#947;&#943;&#945; &#902;&#955;&#956;&#960;&#959;&#965;&#956; </a>";
 						 $out.="</li>";
 						 	$out.="<li>";	
  							$out.="<a href='search.html'>&#913;&#957;&#945;&#950;&#942;&#964;&#951;&#963;&#951; &#935;&#961;&#942;&#963;&#964;&#951;</a>";
  							$out.="</li>";
					echo $out;}
					?></li>
					</ul>
				</li>
				<!-- end li#submenu -->
				<li id="news">
					<h2>&#923;&#949;&#953;&#964;&#959;&#965;&#961;&#947;&#943;&#949;&#962;</h2>
					<ul>
					<li>
							<a href="viewnews.php">OI &#913;&#957;&#945;&#954;&#959;&#953;&#957;&#974;&#963;&#949;&#953;&#962; &#956;&#959;&#965;</a>
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
