<?php
session_start();
 


//end of overrides

function isAdmin() {
 if (($_SESSION['loggedin'] == 1) and ($_SESSION['username'] == 'admin@memberadmin.co.nz')) 
     return true;
 else 
      return false;
}
//function to check if the user is logged else send to the login page 

function checkUser() {
return true;
    $_SESSION['URI'] = '';    
    if ($_SESSION['loggedin'] == 1)
       return TRUE;
    else {
       $_SESSION['URI'] = 'http://localhost'.$_SERVER['REQUEST_URI']; //save current url for redirect     
       header('Location: http://localhost/login.php', true, 303);       
    }       
}
//just to show we are are logged in
function loginStatus() {
    
    if ($_SESSION['loggedin'] == 1){     
        $un = $_SESSION['username'];
        echo "<h2>Logged in as $un</h2>";
      } 
      else
      {
            echo "<h2>Logged out</h2>";            
      }
}

//log a user in
function login($email, $password) {
   //simple redirect if a user tries to access a page they have not logged in to
   if ($_SESSION['loggedin'] == 0 and !empty($_SESSION['URI']))        
        $uri = $_SESSION['URI'];          
   else { 
     $_SESSION['URI'] =  'http://localhost/index.php';         
     $uri = $_SESSION['URI'];           
   }  

   $_SESSION['loggedin'] = 1;        
   $_SESSION['password'] = $password;
   $_SESSION['username'] = $email;
   $_SESSION['role'] = $role; 
   $_SESSION['URI'] = ''; 
   header('Location: '.$uri, true, 303);        
exit();
}



//simple logout function
function logout(){
  $_SESSION['loggedin'] = false;
           
  $_SESSION['username'] = '';
  $_SESSION['role'] = 0;
  header('Location: http://localhost/login.php');    
}
?>