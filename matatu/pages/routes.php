<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matatu Sacco App</title>

    <link rel="stylesheet" href="../css/custom-styles.css">
    <!-- <link rel="stylesheet" href="../css/drivers.css"> -->
    <link rel="stylesheet" href="../css/members.css">


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
<?php include '../pages/header.php'; ?>

    <div class="dform-wrapper">
    <?php
include 'dbconnect.php';

if (isset($_POST['add_route'])) {
    // Get the form input values
    $routeName = $_POST['routeName'];
    $description = $_POST['description'];

    // Check if the route already exists in the table
    $query = "SELECT * FROM routes WHERE RouteName = '$routeName'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Route already exists
        $error = "Route with name $routeName already exists.";
    } else {
        // Route does not exist, insert into the table
        $insertQuery = "INSERT INTO routes (RouteName, Description) 
                        VALUES ('$routeName', '$description')";

        if (mysqli_query($db, $insertQuery)) {
            // Route added successfully
            $success = "Route added successfully.";
        } else {
            // Failed to add route
            $error = "Failed to add route. Please try again.";
        }
    }
}
?>
<form method="POST">
    <h1>Add New Route</h1>
    <div>
        <label for="routeName">Route Name:</label>
        <input type="text" id="routeName" name="routeName" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
    </div>
    <button type="submit" name="add_route">Add Route</button>
</form>


    </div>

    <div class="show-drivers">
        <h2>Routes (0)</h2>
        <?php
include 'dbconnect.php';

// Retrieve routes from the database
$query = "SELECT * FROM routes";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $routeID = $row['RouteID'];
        $routeName = $row['RouteName'];
        $description = $row['Description'];

        // Generate a card for each route
        echo '<div class="dcard">';
        echo '<div class="dcard-content">';
        echo '<h2>' . $routeName . '</h2>';
        echo '<p>Route ID: ' . $routeID . '</p>';
        echo '<p>Description: ' . $description . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    // No routes found
    echo '<p>No routes found.</p>';
}
?>

    </div>

    <!-- <?php include '../pages/footer.php'; ?> -->


</body>

</html>
