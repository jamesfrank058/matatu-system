<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matatu Sacco App</title>

    <link rel="stylesheet" href="../css/custom-styles.css">
    <!-- <link rel="stylesheet" href="../css/drivers.css"> -->
    <link rel="stylesheet" href="../css/matatus.css">


    <link rel="stylesheet" href="../css/login-styles.css">

    <style>
        .show-drivers {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .dcard {
            width: 250px;
            height: 300px;
            background-color: rgb(4, 50, 78, .5);
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
</body>
<?php include '../pages/header.php'; ?>
<div class="dform-wrapper">
    <?php
    include 'dbconnect.php';

if (isset($_POST['add_matatu'])) {
    // Get the form input values
    $matatuNumber = $_POST['matatuNumber'];
    $owner = $_POST['owner'];
    $route = $_POST['route'];

    // Check if the matatu already exists in the table
    $query = "SELECT * FROM matatus WHERE MatatuNumber = '$matatuNumber'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Matatu already exists
        $error = "Matatu with number $matatuNumber already exists.";
    } else {
        // Matatu does not exist, insert into the table
        $insertQuery = "INSERT INTO matatus (MatatuNumber, Owner, Route) 
                        VALUES ('$matatuNumber', '$owner', '$route')";

        if (mysqli_query($db, $insertQuery)) {
            // Matatu added successfully
            $success = "Matatu added successfully.";
        } else {
            // Failed to add matatu
            $error = "Failed to add matatu. Please try again.";
        }
    }
}
?>

<form method="POST">
    <h1>Add New Matatu</h1>
    <div class="dform-row">
        <label for="matatuNumber">Matatu Number:</label>
        <input type="text" id="matatuNumber" name="matatuNumber" required>
    </div>
    <div class="dform-row">
        <label for="owner">Owner:</label>
        <input type="text" id="owner" name="owner" required>
    </div>
    <div class="dform-row">
        <label for="route">Route:</label>
        <input type="text" id="route" name="route" required>
    </div>
    <div class="dform-row">
        <button type="submit" name="add_matatu">Add Matatu</button>
    </div>
</form>
</div>
<div class="show-drivers">
    
    <h2>Registered Matatus</h2>

    <?php
    include 'dbconnect.php';

// Retrieve matatus from the database
$query = "SELECT * FROM matatus";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $matatuNumber = $row['matatunumber'];
        $owner = $row['owner'];
        $route = $row['route'];

        // Generate a card for each matatu
        echo '<div class="dcard">';
        echo '<div class="dcard-content">';
        echo '<h2>Matatu Number: ' . $matatuNumber . '</h2>';
        echo '<p>Owner: ' . $owner . '</p>';
        echo '<p>Route: ' . $route . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    // No matatus found
    echo '<p>No matatus found.</p>';
}
?>


</div>


</body>
</html>
