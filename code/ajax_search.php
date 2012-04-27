<?php
include 'config.inc.php';
	// Retrieve data from Query String
$age = $_GET['name'];
$sex = $_GET['surname'];
$wpm = $_GET['email'];
	// Escape User Input to help prevent SQL Injection
$age = mysql_real_escape_string($age);
$sex = mysql_real_escape_string($sex);
$wpm = mysql_real_escape_string($wpm);
	//build query
$query = "SELECT * FROM user_info WHERE name='$age' OR surname='$sex' OR email='$wpm'";
echo  "<br />";
echo "Ψάχνετε για τον χρήστη με  όνομα: " . $age . "<br /><br/>";
echo " για τον χρήστη με επίθετο: " . $sex . "<br /><br/>";
echo " για τον χρήστη με email: " . $wpm . "<br /><br/>";
	//Execute query
$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
$display_string = "<table width='100%' border='0' cellpadding='5'>";
$display_string .= "<tr bgcolor='#eeeeee'>";
$display_string .= "<td>Όνομα</td>";
$display_string .= "<td>Επίθετο</td>";
$display_string .= "<td>Email</td>";
$display_string .= "</tr>";

	// Insert a new row in the table for each person returned
while($row = mysql_fetch_array($qry_result)){
	$display_string .= "<tr>";
	$display_string .= "<td>$row[name]</td>";
	$display_string .= "<td>$row[surname]</td>";
	$display_string .= "<td>$row[email]</td>";
	$display_string .= "</tr>";
	
}



$display_string .= "</table>";
echo $display_string;


?>
