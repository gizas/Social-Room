<?php
	require("class.phpmailer.php");
   include 'config.inc.php';

	echo "<div id=\"response\">";


  $name            = $_POST['name'];
  $email           = $_POST['email'];
  $telephone       = $_POST['telephone'];
  $password      = $_POST['password'];
  $message         = $_POST['surname'];
  
  if ( ($name=='') && ($email=='')&& ($message=='')) { 
  
  		echo "<p><span>*Ελλειπής Συμπλήρωση</span></em></p>";
  	
  }
  else {
  
	 	echo "<p>Επιτυχης αποστολή!</p>";
		echo "<ul>";
		echo "<li>Όνομα: ".$name."</li>";
	 	echo "<li>E-mail: ".$email."</li>";
	 	echo "<li>Επίθετο:".$message."</li>";
	 	echo "<li>Password: ******</li>";
		echo "<li>Τηλέφωνο: ".$telephone."</li>";
		
		echo "</ul>";
  }  
  echo "</div>";
  
 


$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "webmail.ceid.upatras.gr"; // SMTP servers
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "gizas"; // SMTP username
$mail->Password = "1andreas"; // SMTP password



$subject = "Login to MY Book. <br/> Follow the link to login > http://localhost/askhsh/login.html";

if (!$email) {
echo "Insert email";
exit;
}

if (!ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+@[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$',$email) ) {

echo "Wrong  Email !";
exit;
}

if (!isset($name) || empty($name)) {
echo "Insert name";
exit;
}


if (!$message) {
echo "Εισάγετε Επίθετο";
exit;
}

$user_message .= "Name: $name \r\n";
$user_message .= "Surname: $message \r\n";
$user_message .= "Email: $email \r\n";
$user_message .= "Password: $password \r\n";
$user_message .= "Subject: $subject \r\n";

$headers = "- Contact Form \r\n";
$headers .= "Reply-To: $email";

mail($email,'Contact Reply',$user_message,$headers);

// Set the SMTP Server
ini_set("SMTP","webmail.ceid.upatras.gr");

$query1 = "INSERT INTO myuser (userName,userPass,isAdmin)
             VALUES ('$email','$password','-1')";
  
  mysql_query($query1) or die('Error, query failed');
$query2 = mysql_query( "SELECT ID,userName
						FROM myuser WHERE userName='$email'" );
$info = mysql_fetch_array( $query2 ); 
		$k=$info['ID'];

$query = "INSERT INTO user_info (name,email,surname,telephone,my_id)
             VALUES ('$name',
                     '$email',
                     '$message',
                     '$telephone',
						'$k')";
  
  mysql_query($query) or die('Error3, query failed');
?>         
            
            
            