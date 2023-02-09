
<!DOCTYPE html>
<html>
  <head>
    <title>Home page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/style.css" title="style" />
 
  </head>
  <body>
 
    <div id="main">
    <div id="header">
        <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">The Motueka Bed and Breakfast<span class="logo_colour"></span></a></h1>
        
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="current_bookings.php">Current Bookings</a></li>
          <li><a href="makebooking.php">Make a Booking</a></li>
          <li><a href="privacy.html">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
     
      <div id="content">
      <?php 
        include 'checksession.php'; 
        loginStatus();   
      ?> 
      <h1>The Motueka Bed and Breakfast </h1>
      
      <h2>Menu</h2>

    <ul>
      
      <li><a href="current_bookings.php">Current bookings</a>
      <li><a href="makebooking.php">Make a booking</a>
      <li><a href="login.php">Login</a>
      <li><a href="logout.php">Log Out</a>   
    </ul>
   </div>
</div>
    <div id="footer">
    The Motueka Bed and Breakfast  <li><a href="privacy.html">Privacy Policy</a></li>
    </div>
  
  </div>   
  </body>
    
</html>