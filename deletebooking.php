<!DOCTYPE HTML>
<html><head><title>Booking preview before deletion</title> </head>
 <body> <h1>Booking preview before deletion</h1>
<h2><a href="current_bookings.php">[Return to the member listing]</a></h2>
 
<?php
include "config.php"; //load in any variables
include "cleaninput.php";
$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
 

//check if the connection was good
if (mysqli_connect_errno()) {
    echo  "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}
 
//retrieve the bookingID from the URL
if($_SERVER["REQUEST_METHOD"] == "GET")
{
    $id = $_GET['id'];
    if(empty($id) or !is_numeric($id))
	{
        echo "<h2>Invalid booking ID</h2> "; //simple error feedback
        exit;
    } 
}
 
 
//check if you are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) 
    and ($_POST['submit'] == 'Delete'))
{     
    $error = 0; //clear our error flag
    $msg = 'Error: ';  
//bookingID (sent via a form it is a string not a number so you try a type conversion!)    
    if (isset($_POST['id']) and !empty($_POST['id']) 
        and is_integer(intval($_POST['id'])))
	{
        $id = cleanInput($_POST['id']); 
    }
	else
	{
        $error++; //bump the error flag
        $msg .= 'Invalid booking ID '; //append error message
        $id = 0;  
    }        
    
//save the member data if the error flag is still clear and member id is > 0
    if($error == 0 and $id > 0)
	{
        $query = "DELETE FROM booking WHERE bookingID=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'i', $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h2>Booking details deleted.</h2>";        
    }
	else
	{ 
      echo  "<h2>$msg</h2>";
    }      
}
 
//prepare a query and send it to the server
$query = "SELECT booking.checkInDate, booking.checkOutDate, booking.contactNumber, booking.bookingExtras, booking.roomReview, room.roomname, room.roomtype, room.beds FROM room  INNER JOIN booking ON booking.roomID = room.roomID WHERE booking.bookingID = $id";
$result = mysqli_query($db_connection, $query);
$row_count = mysqli_num_rows($result); 
 
 

if ($row_count > 0)  {  
   echo "<fieldset> <legend>Booking detail #$id</legend> <dl> "; 
   $row = mysqli_fetch_assoc($result);
   echo "<dt>Room (name, type, beds):</dt>        <dd>".$row['roomname'],", " .$row['roomtype'], ", " .$row['beds']."</dd>";       echo "<dt>Checkin date:</dt> <dd>".$row['checkInDate']."</dd> ";
   echo "<dt>Checkout date:</dt> <dd>".$row['checkOutDate']. "</dd>";
   echo "<dt>Contact number:</dt> <dd>".$row['contactNumber']."</dd> ";
   echo "<dt>Extras:</dt> <dd>".$row['bookingExtras']."</dd> "; 
   echo "<dt>Room review:</dt> <dd>".$row['roomReview']."</dd>";  
   echo "</dl></fieldset>";  
  ?>
   <form method= "POST" action= "deletebooking.php">
     <h2>Are you sure you want to delete this member?</h2>
 
     <input type= "hidden" name= "id" value= "<?php echo $id; ?>">
     <input type= "submit" name= "submit" value= "Delete">
     <a href= "current_bookings.php">[Cancel]</a>
    </form>
    
 

<?php
}

mysqli_free_result($result); //free any memory used by the query
mysqli_close($db_connection); //close the connection once done
?>
 
</body>
</html>