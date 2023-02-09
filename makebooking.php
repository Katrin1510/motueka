<!DOCTYPE HTML>
<html>
  <head>
    <title>Make a booking</title>
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
          <!-- class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Home</a></li>
          <li><a href="current_bookings.php">Current Bookings</a></li>
          <li class="selected"><a href="makebooking.php">Make a Booking</a></li>
          <li><a href="privacy.html">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
     
      <div id="content">
<?php
 
include "cleaninput.php";
include "config.php"; //load in any variables

$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

if (mysqli_connect_errno()) {
echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
exit; //stop processing the page further
};


//the data was sent using a formtherefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Add')) {
 
  $error = 0; //clear our error flag
  $msg = 'Error: ';
}
 
  $con = mysqli_connect("localhost","root","root","motueka");
  $sql = "SELECT roomID, roomname, roomtype, beds FROM room";
  $allrooms = mysqli_query($con, $sql);
  
     
    
    if(isset($_POST['submit']))
  {
      
      $roomname = mysqli_real_escape_string($db_connection,$_POST['room']);
      $roomtype = mysqli_real_escape_string($db_connection,$_POST['room']);
      $beds = mysqli_real_escape_string($db_connection,$_POST['room']);
      $roomID = mysqli_real_escape_string($con,$_POST['room']);
      $customerID = mysqli_real_escape_string($con,$_POST['customerID']);   
      $checkInDate = cleanInput($_POST['checkInDate']);
      $checkOutDate = cleanInput($_POST['checkOutDate']);

    if (isset($_POST['contactNumber']) and !empty($_POST['contactNumber']) and is_string($_POST['contactNumber'])) {
        $fn = cleanInput($_POST['contactNumber']); 
        $contactNumber = (strlen($fn)>50)?substr($fn,1,50):$fn; //check length and clip if too big
            
        } else {
        $error++; //bump the error flag
        $msg .= 'Invalid contact number '; //append eror message
        $contactNumber = '';  
        } 

    if (isset($_POST['bookingExtras']) and !empty($_POST['bookingExtras']) and is_string($_POST['bookingExtras'])) {
       $fn = cleanInput($_POST['bookingExtras']); 
       $bookingExtras = (strlen($fn)>50)?substr($fn,1,50):$fn; //check length and clip if too big
             
    } else {
       $error++; //bump the error flag
       $msg .= 'Invalid booking extras '; //append eror message
       $bookingExtras = '';  
    } 
   
     
    
    if (isset($_POST['roomReview']) and !empty($_POST['roomReview']) and is_string($_POST['roomReview'])) {
    $fn = cleanInput($_POST['roomReview']); 
    $roomReview = (strlen($fn)>50)?substr($fn,1,50):$fn; //check length and clip if too big
       
    } else {
    $error++; //bump the error flag
    $msg .= 'Invalid roomReview '; //append eror message
    $roomReview = '';  
    }
        
      
    // Creating an insert query using SQL syntax and
    // storing it in a variable.
    $sql  =
    "INSERT INTO booking(customerID, checkInDate, checkOutDate, roomID, contactNumber, bookingExtras, roomReview  ) VALUES (?, ?, ?, ?, ?, ?, ?)";
      
      // The following code attempts to execute the SQL query
      // if the query executes with no errors
      // a javascript alert message is displayed
      // which says the data is inserted successfully
    $stmt = mysqli_prepare($db_connection, $sql); //prepare the query
    mysqli_stmt_bind_param($stmt,'issiiss', $customerID, $checkInDate, $checkOutDate, $roomID, $contactNumber, $bookingExtras,  $roomReview); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);    
    echo '<script>alert("New booking added successfully")</script>';
    }
     
    mysqli_close($db_connection); //close the connection once done

?>

<h1>Book a room</h1>
<h2><a href='current_bookings.php'>[Return to the current bookings]</a><a href='index.php'>[Return to the main page]</a></h2>
  
  <form method="POST" action="makebooking.php">
    <p>  
    <label for="customerID">Customer ID: </label>
    <input type="number" id="customerID" name="customerID"  required> 
    </p>
     
    <p>     
    <label>Select a Room</label>
    <select name="room">
        <option value="">- SELECT A ROOM-</option>
        
        <?php
            // use a while loop to fetch data
            // from the $allrooms variable
            // and individually display as an option
            while ($room = mysqli_fetch_array(
                    $allrooms,MYSQLI_ASSOC)):;
        ?>
            <option value="<?php echo $room['roomID'];
                // The value we usually set is the primary key
            ?>">
                <?php echo $room['roomname'], ", ", $room['roomtype'], ", ",  $room['beds'];
                    // To show the roomname, roomtype and beds to the user
                ?>
            </option>
        <?php
            endwhile;
            // While loop must be terminated
        ?>
    </select>

    </p>

    <p>
    <label for="checkInDate">Checkin date: </label>
    <input type="date" id="checkInDate" name="checkInDate" minlength="5" maxlength="50" value="<?php echo $row['checkInDate']; ?>" required> 
    </p> 
    
    <p>
    <label for="checkOutDate">Checkout Date: </label>
    <input type="date" id="checkOutDate" name="checkOutDate" size="100" minlength="5" maxlength="200" value="<?php echo $row['checkOutDate']; ?>" required> 
    </p>  
    
    <p>  
    <label for="bookingExtras">Booking extras: </label>
    <input type="text" id="bookingExtras" name="bookingExtras" size="100" minlength="10" maxlength="200"  required> 
    </p>

    <p>  
    <label for="contactNumber">Contact number: </label>
    <input type="number" id="contactNumber" name="contactNumber" size="50" minlength="10" maxlength="50" required> 
    </p>
          
    <p>  
    <label for="roomReview">Room review: </label>
    <input type="text" id="roomReview" name="roomReview" size="50" minlength="10" maxlength="50" required> 
    </p>   
       
   <input type="submit" name="submit" value="Submit">
  </form>

     </div>
</div>
    <div id="footer">
    The Motueka Bed and Breakfast  <li><a href="privacy.html">Privacy Policy</a></li>
    </div>
  
  </div>   
</body>
</html>
  