
<!DOCTYPE HTML>
<html>
    <head>
        <title>Current Bookings</title>
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
          <!-- class="selected" in the link tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Home</a></li>
          <li class="selected"><a href="current_bookings.php">Current Bookings</a></li>
          <li><a href="makebooking.php">Make a Booking</a></li>
          <li><a href="privacy.html">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
    <?php 
       include 'checksession.php';
       loginStatus();
        if(!isAdmin()) 
        { 
         header('Location: http://localhost/index.php');  
         exit(); 
        }
    ?>
      <div id="content">  
 

<?php 


include "config.php "; //load in any variables
$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if (mysqli_connect_errno())
{
    echo  "Error: Unable to connect to MySQL. ".mysqli_connect_error();
    exit;
}

$query = "SELECT booking.bookingID, booking.checkInDate, booking.checkOutDate, customer.firstname, customer.lastname FROM booking  INNER JOIN customer on booking.customerID=customer.customerID ORDER BY lastname";
$result = mysqli_query($db_connection, $query);
$rowcount = mysqli_num_rows($result); 
?>
 
<h1>Current Bookings</h1>
 
<h2>Member count <?php echo $rowcount; ?></h2>
 
<h2><a href='makebooking.php'>[Make a booking]</a></h2>
<h2><a href='index.php'>[Return to main page]</a></h2>
<table border= "1">
<thead><tr><th>First Name</th><th>Last Name</th><th>Checkin Date</th><th>Checkout Date</th><th>Actions</th></tr></thead>
 

<?php
// check that you have bookings retrieved
if ($rowcount > 0)
{  
 
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['bookingID'];    
        echo '<tr><td>'.$row['firstname'].'</td><td>'.$row['lastname'].'</td><td>'.$row['checkInDate'].'</td><td>'.$row['checkOutDate'].'</td>';
        echo '<td><a href= "viewbooking.php?id='.$id.' ">[view]</a>';
        echo '<a href= "editbooking.php?id='.$id.' ">[edit]</a>';
        echo '<a href= "deletebooking.php?id='.$id.' ">[delete]</a></td>';
        echo '</tr>';
   }
} 
else
{
    echo "<h2>No bookings found!</h2> "; //suitable feedback
}
mysqli_free_result($result); 
mysqli_close($db_connection);
?>
 
</table>
</div>
</div>
    <div id="footer">
    The Motueka Bed and Breakfast  <li><a href="privacy.html">Privacy Policy</a></li>
    </div>
  
  </div>   
</body>
</html>