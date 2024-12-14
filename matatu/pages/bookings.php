<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Booking</title>

    <link rel="stylesheet" href="../css/custom-styles.css">
    
    <link rel="stylesheet" href="../css/matatus.css">

    <style>
        /* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Set a background color and text color for the body */
body {
    background-color: #f4f4f4;
    color: #333;
    font-family: Arial, sans-serif;
}

/* Add some spacing and center the content */
#booking-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Style the form inputs and labels */
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

form input[type="text"],
form input[type="datetime-local"],
form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

/* Style the submit button */
form button[type="submit"] {
    background-color: #006266;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button[type="submit"]:hover {
    background-color: #004d4d;
}

/* Style the header */


/* Style for the tables */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

/* Style for the section headers */
h2 {
    margin-top: 30px;
}

/* Style for the page container */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}


/* Style for the tables */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
    animation: fadeIn 0.5s ease-in-out;
    margin: 20px;
    color: white;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
    font-size: 20px;
    color: black;
    background: #006266;
}

/* Style for the section headers */
h2 {
    margin-top: 30px;
    color: #006266;
    font-size: 24px;
}

/* Style for the page container */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Animation for fading in */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

#mytable{
    background: #1289A7;
}
#mytable1{
    background: #833471;
}


    </style>
</head>
<body>

<!-- for payment info processing -->
<?php
include 'dbconnect.php'; // Include your database connection

if (isset($_POST['submit_booking'])) {
    $name = $_POST['name'];
    $pickup_datetime = $_POST['pickup_datetime'];
    $dropoff_location = $_POST['dropoff_location'];
    $route_id = $_POST['route_id'];
    
    $getRouteQuery = "SELECT start_location, end_location, distance, price FROM routes WHERE route_id = ?";
    $stmt = $db->prepare($getRouteQuery);
    $stmt->bind_param("i", $route_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $start_location = $row['start_location'];
        $end_location = $row['end_location'];
        $distance = $row['distance'];
        $price = $row['price'];
        
        // Insert data into 'bookings' table
        $insertBookingQuery = "INSERT INTO bookings (pickup_datetime, dropoff_location, route_id, start_location, end_location, distance, price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($insertBookingQuery);
        $stmt->bind_param("ssisssd", $pickup_datetime, $dropoff_location, $route_id, $start_location, $end_location, $distance, $price);
        if ($stmt->execute()) {
            $booking_id = $stmt->insert_id;
            $stmt->close();
            
            // Insert data into 'payments' table
            $amount = $price; // Assuming amount is the same as the booking price
            $payment_method = $_POST['payment_method'];
            $payment_date = date("Y-m-d H:i:s");
            
            $insertPaymentQuery = "INSERT INTO payments (booking_id, amount, payment_method, payment_date, passenger) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($insertPaymentQuery);
            $stmt->bind_param("idsss", $booking_id, $amount, $payment_method, $payment_date, $name);
            if ($stmt->execute()) {
               
            } else {
                echo "Error inserting payment: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error inserting booking: " . $stmt->error;
        }
    } else {
        echo "Route not found.";
    }
    
    $db->close();
}


?>


<!-- for booking processing -->
<?php
include 'dbconnect.php'; 

if (isset($_POST['submit_booking'])) {
    $name = $_POST['name'];
    $pickup_datetime = $_POST['pickup_datetime'];
    $dropoff_location = $_POST['dropoff_location'];
    $route_id = $_POST['route_id'];

    $getRouteQuery = "SELECT start_location, end_location, distance, price FROM routes WHERE route_id = ?";
    $stmt = $db->prepare($getRouteQuery);
    $stmt->bind_param("i", $route_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $start_location = $row['start_location'];
        $end_location = $row['end_location'];
        $distance = $row['distance'];
        $price = $row['price'];
        
        // Insert data into 'bookings' table
        $insertQuery = "INSERT INTO bookings (pickup_datetime, dropoff_location, route_id, start_location, end_location, distance, price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param("ssisssd", $pickup_datetime, $dropoff_location, $route_id, $start_location, $end_location, $distance, $price);
        if ($stmt->execute()) {
            // echo "Booking successfully added!";
            echo '<script>alert("Booking and payment successful")</script>';
        } else {
            echo "Error inserting booking: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Route not found.";
    }
    
    $db->close(); // Close the database connection
}
?>

    <?php include 'dbconnect.php'; ?>
    <?php include 'header.php'; ?>

    <section id="booking-form">
        <h2>Make a Booking</h2>
        <?php
        // Retrieve route_id from the URL query parameter
        $route_id = $_GET['route_id'];

        // Fetch route details based on route_id
        $route_query = "SELECT * FROM routes WHERE route_id = $route_id";
        $route_result = $db->query($route_query);
        $route = $route_result->fetch_assoc();

        if ($route) {
            echo "<h3>Route: " . $route['route_name'] . "</h3>";
            echo "<p>Start Location: " . $route['start_location'] . "</p>";
            echo "<p>End Location: " . $route['end_location'] . "</p>";
            echo "<p>Distance: " . $route['distance'] . " km</p>";
            echo "<p>Price: Ksh. " . $route['price'] . "</p>";

            // Display booking form
            echo "<form method='post'>";
            echo "<input type='hidden' name='route_id' value='" . $route_id . "'>";
            echo "<label for='name'>Full Name:</label>";
            echo "<input type='text' name='name' required>";
            echo "<label for='pickup_datetime'>Pickup Date and Time:</label>";
            echo "<input type='datetime-local' name='pickup_datetime' required>";
            echo "<label for='dropoff_location'>Dropoff Location:</label>";
            echo "<input type='text' name='dropoff_location' required>";
            echo "<label for='payment_method'>Payment Method:</label>";
            echo "<select name='payment_method' required>";
            echo "<option value='cash'>Cash</option>";
            echo "<option value='loyalty_points'>Loyalty Points</option>";
            echo "<option value='mpesa'>Mpesa</option>";
            // Add more payment methods here if needed
            echo "</select>";
            echo "<button type='submit' name='submit_booking'>Submit Booking</button>";
            echo "</form>";
            
            
        } else {
            echo "Route not found.";
        }
        ?>
    </section>

    <!-- BOOKINGS -->

    <?php
include 'dbconnect.php'; // Include your database connection

$queryPayments = "SELECT * FROM payments";
$resultPayments = $db->query($queryPayments);

if ($resultPayments->num_rows > 0) {
    echo "<h2>Payments Data</h2>";
    echo "<table id='mytable1'>";
    echo "<tr><th>Payment ID</th><th>Booking ID</th><th>Amount</th><th>Payment Method</th><th>Payment Date</th><th>Passenger</th></tr>";

    while ($row = $resultPayments->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['payment_id'] . "</td>";
        echo "<td>" . $row['booking_id'] . "</td>";
        echo "<td>" . $row['amount'] . "</td>";
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "<td>" . $row['payment_date'] . "</td>";
        echo "<td>" . $row['passenger'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No payments found.";
}

$db->close(); // Close the database connection
?>

<!-- PAYMENTS -->
<?php
include 'dbconnect.php'; // Include your database connection

$queryBookings = "SELECT * FROM bookings";
$resultBookings = $db->query($queryBookings);

if ($resultBookings->num_rows > 0) {
    echo "<h2>Bookings Data</h2>";
    echo "<table id='mytable'>";
    echo "<tr><th>Booking ID</th><th>Pickup Date and Time</th><th>Dropoff Location</th><th>Route ID</th><th>Start Location</th><th>End Location</th><th>Distance (km)</th><th>Price</th></tr>";

    while ($row = $resultBookings->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['booking_id'] . "</td>";
        echo "<td>" . $row['pickup_datetime'] . "</td>";
        echo "<td>" . $row['dropoff_location'] . "</td>";
        echo "<td>" . $row['route_id'] . "</td>";
        echo "<td>" . $row['start_location'] . "</td>";
        echo "<td>" . $row['end_location'] . "</td>";
        echo "<td>" . $row['distance'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No bookings found.";
}

$db->close(); // Close the database connection
?>



</body>
</html>
