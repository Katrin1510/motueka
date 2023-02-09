<?php 
include 'checksession.php';
?>

<!DOCTYPE html> 
 <html lang="en"> 
     <head> 
         <title>Customer Login</title> 
         <meta charset="UTF-8"> 
         <meta name="viewport" content="width=device-width, initial-scale=1"> 
     </head> 
 <body>  
    
    
<?php
include "config.php"; //load in any variables

$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
 
//check if the connection was good
if (mysqli_connect_errno()) {
    echo  "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}
      

// if the login form has been filled in 
    if (isset($_POST['email'])) 
    { 
        $email = $_POST['email']; 
        $password = $_POST['password']; 
        
 
//prepare a query and send it to the server 
        $stmt = mysqli_stmt_init($db_connection); 
        mysqli_stmt_prepare($stmt, "SELECT customerID, password, role FROM customer WHERE email=?"); 
        mysqli_stmt_bind_param($stmt, "s", $email); 
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_bind_result($stmt, $customerID, $hashpassword, $role); 
        mysqli_stmt_fetch($stmt); 

        // this is where the password is checked 
        
    if(!$customerID) 
    { 
        echo  '<p class="error">Unable to find member with email!'.$email.'</p>'; 
    }
    else 
    { 
        if (password_verify($password, $hashpassword)) 
        { 
                $_SESSION['loggedin'] = true; 
                $_SESSION['username'] = $email; 
                
                $_SESSION['role'] = $role;

                echo  '<p>Congratulations, you are logged in!</p>'; 
                echo $role;

                header('location: index.php');
        }  
        else 
        { 
         echo   '<p>Username/password combination is wrong!</p>'; 
         echo '<p><a href="index.php">Return to the menu</a></p>'; 
        } 
    }
    }
    ?>
     
     
<form method="POST" action="login.php"> 
    <h1>Customer Login</h1> 
    <label for="email">User name: </label> 
    <input type="email" id="email" size="30" name="email" required>  
  
    <p> 
    <label for="password">Password: </label> 
    <input type="password" id="password" size="60" name="password" min="10" max="255" required>  
    </p> 

    <input type = "submit" name="submit" value="Login">
 
    <p><a href="index.php">Return to the menu</a></p>
    <p><a href="logout.php">Log Out</a></p>
</form>
     
</body>
</html>
