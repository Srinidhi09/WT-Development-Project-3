<?php
function ExtendedAddslash(&$params)


{ 
        foreach ($params as &$var) {
            // check if $var is an array. If yes, it will start another ExtendedAddslash() function to loop to each key inside.
            is_array($var) ? ExtendedAddslash($var) : $var=addslashes($var);
            unset($var);
        }
} 

// Initialize ExtendedAddslash() function for every $_POST variable
ExtendedAddslash($_POST);      

$Name = $_POST['Name']; 
$Email = $_POST['Email'];
$Subject = $_POST['Subject'];
$Message = $_POST['Message'];


$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'form_authentication';

$con=mysqli_connect( $db_host, $db_username, $db_password,$db_name) or die(mysqli_connect_errno());
//mysqli_select_db(); 

// search submission ID

$query = "SELECT * FROM `contact_form` WHERE `Name` = '$Name'";
$sqlsearch = mysqli_query($con,$query);
$resultcount = mysqli_num_rows($sqlsearch);

if ($resultcount > 0) {
 
    mysqli_query($con,"UPDATE `contact_form` SET 
                                `Name` = '$Name',
                                `Email` = '$Email',
                                `Subject` = '$Subject',
                                `Message` = '$Message',
                             WHERE `Name` = 'Name'") 
     or die(mysqli_connect_errno());
	
    
} else {

    mysqli_query($con, "INSERT INTO `contact_form` (Name, Email, Subject, Message) 
                               VALUES ('$Name', '$Email', 
                                                 '$Subject', '$Message') ") 
    or die(mysql_error()); 

}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Sucess</title>
</head><br><br><br>
<body style="background-color:#d4f1f7"><br>
<h1 style="color:red; font-family:Constantia; text-align:center;">CONGRATS! </h1><br>
<h1 style="color:red; font-family:Constantia; text-align:center;">Your message has been sent...</h1><br>
</body>
</html>
