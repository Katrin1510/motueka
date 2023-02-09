<!DOCTYPE HTML><html>
<head>    <title>Booking Details View</title></head>
<body>    
    
    <h1>Booking Details View</h1>    
<h2><a href='current_bookings.php'>[Return to the current bookings]</a></h2>
    <?php
    
    include "config.php"; //load in any variables      
     $db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
    if (mysqli_connect_errno())        
    {            
    echo  "Error: Unable to connect to MySQL. ".mysqli_connect_error();
    exit;        
    }

    if($_SERVER["REQUEST_METHOD"]=="GET")
    {         
        $id = $_GET['id'];
            
        if(empty($id) or !is_numeric($id))
        {
        echo "<h2>Invalid member ID</h2>";
        exit;         
        }    
    }  
    // prepare a query and send it to the server    
        $query = "SELECT booking.checkInDate, booking.checkOutDate, booking.contactNumber, booking.bookingExtras, booking.roomReview, room.roomname, room.roomtype, room.beds FROM room  INNER JOIN booking ON booking.roomID = room.roomID WHERE booking.bookingID = $id";
        $result = mysqli_query($db_connection, $query);    
        $row_count= mysqli_num_rows($result);// check the result set for data    
            
     
    if($row_count > 0)     
    {               
    echo "<fieldset>    <legend>Booking detail# $id</legend>    <dl>";     
    $row = mysqli_fetch_assoc($result);          
    echo "<dt>Room (name, type, beds):</dt>        <dd>".$row['roomname'],", " .$row['roomtype'], ", " .$row['beds']."</dd>";                
    echo "<dt>Checkin date:</dt>        <dd>".$row['checkInDate']."</dd>";                
    echo "<dt>Checkout date:</dt>        <dd>".$row['checkOutDate']."</dd>";
    echo "<dt>Contact number:</dt>        <dd>".$row['contactNumber']."</dd>";
    echo "<dt>Extras:</dt>        <dd>".$row['bookingExtras']."</dd>"; 
    echo "<dt>Room review:</dt>        <dd>".$row['roomReview']."</dd>"; 
    echo "</dl></fieldset>";    
    }

    mysqli_free_result($result); // free any memory used by the query        
    mysqli_close($db_connection); //close the connection once done   
    ?>

    </body>
</html>