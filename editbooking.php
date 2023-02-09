<!DOCTYPE HTML>
<html><head><title>Edit a booking</title> </head>
 <body>

<?php
include "config.php"; //load in any variables
include "cleaninput.php";

$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
$error=0;
if (mysqli_connect_errno()) {
  echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
  exit; //stop processing the page further
};

//retrieve the roomid from the URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    if (empty($id) or !is_numeric($id)) {
        echo "<h2>Invalid room ID</h2>"; //simple error feedback
        exit;
    } 
}
//the data was sent using a form therefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update')) {     
 
    
//roomID (sent via a form ti is a string not a number so we try a type conversion!)    
    if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
       $id = cleanInput($_POST['id']); 
    } else {
       $error++; //bump the error flag
       $msg .= 'Invalid room ID '; //append error message
       $id = 0;  
    }   
   
                 
//checkinDate
       $checkinDate = cleanInput($_POST['checkInDate']); 
//checkoutDate
       $checkoutDate = cleanInput($_POST['checkOutDate']);        
//extras
       $bookingExtras = cleanInput($_POST['bookingExtras']);         
//roomReview
       $roomReview = cleanInput($_POST['roomReview']);         
    
//save the booking data if the error flag is still clear and room id is > 0
    if ($error == 0 and $id > 0)
	  {
        $query = "UPDATE booking SET checkInDate=?, checkOutDate=?, bookingExtras=?, roomReview=? WHERE  bookingID=?";
        
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'ssssi', $checkinDate, $checkoutDate, $bookingExtras, $roomReview, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h2>Room details updated.</h2>";  
    } 
	  else
	  { 
      echo "<h2>$msg</h2>";
    }      
}

//locate the room to edit by using the roomID
// include the room ID in our form for sending it back for saving the data
$query = "SELECT booking.checkInDate, booking.checkOutDate, booking.bookingExtras, booking.roomReview, room.roomname, room.roomtype, room.beds FROM room  INNER JOIN booking ON booking.roomID = room.roomID WHERE booking.bookingID = $id";
$result = mysqli_query($db_connection,$query);
$row_count = mysqli_num_rows($result);
if ($row_count > 0) {
  $row = mysqli_fetch_assoc($result);

?>
<h1>Booking Details Update</h1>
<h2><a href='current_bookings.php'>[Return to the current bookings]</a><a href='index.php'>[Return to the main page]</a></h2>

<form method="POST" action="editbooking.php">
  <input type="hidden" name="id" value="<?php echo $id;?>">
   <p>
    <label for="room">Room (name,type, beds): </label>
    <input type = "text"  name="roomname" minlength="5" maxlength="50" value="<?php echo $row['roomname'], ", ", $row['roomtype'], ", ", $row['beds']; ?>" required> 
  </p>
    
    <p>
    <label for="checkInDate">Checkin date: </label>
    <input type="date" id="checkInDate" name="checkInDate" size="100" minlength="5" maxlength="50" value="<?php echo $row['checkInDate']; ?>" required> 
  </p> 
  <p>
    <label for="checkOutDate">Checkout Date: </label>
    <input type="date" id="checkOutDate" name="checkOutDate" size="100" minlength="5" maxlength="200" value="<?php echo $row['checkOutDate']; ?>" required> 
  </p>  
  <p>  
    <label for="bookingExtras">Booking extras: </label>
    <input type="text" id="bookingExtras" name="bookingExtras" size="100" minlength="1" maxlength="200" value="<?php echo $row['bookingExtras']; ?>" > 
    
   </p>
  <p>
     <label for="roomReview">Room review: </label>
    <input type="text" id="roomReview" name="roomReview" size="100" minlength="5" maxlength="200" value="<?php echo $row['roomReview']; ?>" required>  
  </p> 
   
    
        
     <h2>Are you sure you want to update this booking?</h2>
 
     <input type="submit" name="submit" value="Update"> 
     <a href= "current_bookings.php">[Cancel]</a>
    
    
 </form>

<?php 
} 
else
{ 
  echo   "<h2>room not found with that ID</h2>"; //simple error feedback
}
 
    
mysqli_close($db_connection); //close the connection once done
?>

</body>
</html>
  