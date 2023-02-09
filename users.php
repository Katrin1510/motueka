
<!DOCTYPE HTML>
<html><head><title>Users</title> </head>
 <body>  
 
 
<?php
include "config.php"; //load in any variables
 
$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
 
//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo  "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}
$query = "INSERT INTO customer (firstname, lastname, email, password, role) VALUES (?,?,?,?,?)"; 
$stmt = mysqli_prepare($db_connection, $query); //prepare the query	 
// create hashed password - used for both members, just an example 
$password="temp1234"; 
$hashed_password = password_hash($password, PASSWORD_DEFAULT); 
// admin user 
$firstname = "The"; 
$lastname = "Admin"; 
$email = "admin@memberadmin.co.nz"; 
$role = 9; 
mysqli_stmt_bind_param($stmt,'ssssi', $firstname, $lastname, $email, $hashed_password, $role);  
mysqli_stmt_execute($stmt); 
$firstname = "Ordinary"; 
$lastname = "Member"; 
$email = "amember@amember.co.nz"; 
$role = 1; 
mysqli_stmt_bind_param($stmt,'ssssi', $firstname, $lastname, $email, $hashed_password, $role);  
mysqli_stmt_execute($stmt); 
mysqli_stmt_close($stmt);
?>
</body>
</html>