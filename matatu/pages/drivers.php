<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matatu Sacco App</title>

    <link rel="stylesheet" href="../css/custom-styles.css">
    <link rel="stylesheet" href="../css/drivers.css">

    <link rel="stylesheet" href="../css/login-styles.css">
    <!-- <link rel="stylesheet" href="../css/home-styles.css"> -->


    <style>
     
     .show-drivers {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.dcard {
  width: 250px;
  height:250px;
  background-color: rgb(4, 50, 78, .5);
  /* border-radius: 8px; */
  box-shadow: 0 2px 6px rgba(0, 0, 0);
  margin-bottom: 20px;
}

.dcard-content {
  padding: 20px;
}

.dcard-content h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.dcard-content p {
  margin-bottom: 20px;
}

    </style>
</head>
<body>

<?php include '../pages/header.php'; ?>
 
<div class="dform-wrapper">

<?php
include 'dbconnect.php';

if (isset($_POST['add_driver'])) {
    // Get the form input values
    $fullName = $_POST['full_name'];
    $phoneNumber = $_POST['phone_number'];
    $licenseNumber = $_POST['license_number'];

    // Check if the driver already exists in the table
    $query = "SELECT * FROM drivers WHERE FullName = '$fullName' AND PhoneNumber = '$phoneNumber'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Driver already exists
        $error = "Driver already exists.";
    } else {
        // Driver does not exist, insert into the table
        $insertQuery = "INSERT INTO drivers (FullName, PhoneNumber, LicenseNumber) 
                        VALUES ('$fullName', '$phoneNumber', '$licenseNumber')";

        if (mysqli_query($db, $insertQuery)) {
            // Driver added successfully
            $success = "Driver added successfully.";
        } else {
            // Failed to add driver
            $error = "Failed to add driver. Please try again.";
        }
    }
}
?>


<form method="POST">
    <div class="dform-container">
        <h1>Add New Driver</h1>
        <div class="dform-field">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="dform-field">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>
        <div class="dform-field">
            <label for="license_number">License Number:</label>
            <input type="text" id="license_number" name="license_number" required>
        </div>
        <div class="dform-field">
            <button type="submit" name="add_driver">Add Driver</button>
        </div>
    </div>
</form>
 
</div>

<div class="show-drivers">
    <div class="dshow-container">
        <h2>Registered Drivers</h2>
        <?php
        include 'dbconnect.php';

        // Retrieve drivers from the database
        $query = "SELECT * FROM drivers";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($result)) {
                $fullName = $row['fullname'];
                $phoneNumber = $row['phonenumber'];
                $licenseNumber = $row['licensenumber'];

                // Generate a card for each driver
                echo '<div class="dcard">';
                echo '<div class="dcard-content">';
                echo '<h2>' . $fullName . '</h2>';
                echo '<p>Phone Number: ' . $phoneNumber . '</p>';
                echo '<p>License Number: ' . $licenseNumber . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No drivers found
            echo '<p>No drivers found.</p>';
        }
        ?>
    </div>
</div>

</body>


</html>