<html >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>My Book</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
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
	<div id="page">
		<div id="content">
			
				<center>
<h1> Συμπληρώστε τη φόρμα</h1>
<p>
Εισάγεται τα στοιχεία που απιατούνται
</p>

		<form action="send.php" method="post" id="test">
			<fieldset>
				
				<div>
					<label for="name_Req">Όνομα<span>*</span></label>
					<input type="text" id="name_Req" name="name" title="Required! Όνομα" />
				</div>
					<div>
					<label for="message_Req">Επίθετο<span>*</span></label>
					<input id="message_Req" name="surname" type="text" title="Required! Εισάγετε επίθετο"/>
				</div>
				<div>
					<label for="contact_Req_Email">E-mail<span>*</span></label>
					<input type="text" id="contact_Req_Email" name="email" title="Required! Εισάγετε σωστή email address" />
				</div>
				<div>
					<label for="password_Req">Password<span>*</span></label>
					<input id="password_Req" name="password" type="password" title="Required! Εισάγετε Κωδικό"/>
				</div>
				
				<div>
					<label for="telephone_Tel">Τηλέφωνο</label>
					<input type="text" id="telephone_Tel" name="telephone" title="Please enter a valid telephone number" />
				</div>                
			
				<div class="button">
					<input type="submit" value="Υποβολή" />
        		</div>
			</fieldset>
		</form>
	
	
			
		</div>
		<!-- end div#content -->
	
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

