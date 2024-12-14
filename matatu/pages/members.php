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
<?php
include 'header.php';
?>

<?php


include 'dbconnect.php';


if (isset($_POST['add_member'])) {
    // Get the form input values
    $memberId = $_POST['memberID'];
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $dateOfJoining = $_POST['dateOfJoining'];

    // Check if the member already exists in the table
    $query = "SELECT * FROM members WHERE memberID = '$memberId'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Member already exists
        $error = "Member with ID $memberId already exists.";
    } else {
        // Member does not exist, insert into the table
        $insertQuery = "INSERT INTO members (memberID, fullName, phoneNumber, email, dateOfJoining) 
                        VALUES ('$memberId', '$fullName', '$phoneNumber', '$email', '$dateOfJoining')";

        if (mysqli_query($db, $insertQuery)) {
            // Member added successfully
            $success = "Member added successfully.";
        } else {
            // Failed to add member
            $error = "Failed to add member. Please try again.";
        }
    }
}

// Check if the delete button was clicked
if (isset($_POST['delete_member'])) {
    // Get the member ID to be deleted
    $memberIdToDelete = $_POST['member_id'];

    // Delete the member from the database
    $deleteQuery = "DELETE FROM members WHERE memberID = '$memberIdToDelete'";
    if (mysqli_query($db, $deleteQuery)) {
        $success = "Member deleted successfully.";
    } else {
        $error = "Failed to delete member. Please try again.";
    }
}


?>

<div class="dform-wrapper">
    <form method="POST">
        <h1>Add New Member</h1>
        <div>
            <label for="memberID">Member ID:</label>
            <input type="text" id="memberID" name="memberID" required>
        </div>
        <div>
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>
        <div>
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="dateOfJoining">Date of Joining:</label>
            <input type="date" id="dateOfJoining" name="dateOfJoining" required>
        </div>
        <button type="submit" name="add_member">Add Member</button>
    </form>
</div>

<div class="show-drivers">
    <h2>Registered Members (0)</h2>

    <?php
    include 'dbconnect.php';

    // Retrieve members from the database
    $query = "SELECT * FROM members";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            $memberId = $row['memberid'];
            $fullName = $row['fullname'];
            $phoneNumber = $row['phonenumber'];
            $email = $row['email'];
            $dateOfJoining = $row['dateofjoining'];

            // Generate a card for each member
            echo '<div class="dcard">';
            echo '<div class="dcard-content">';
            echo '<h2>' . $fullName . '</h2>';
            echo '<p>Member ID: ' . $memberId . '</p>';
            echo '<p>Phone Number: ' . $phoneNumber . '</p>';
            echo '<p>Email: ' . $email . '</p>';
            echo '<p>Date of Joining: ' . $dateOfJoining . '</p>';

            // Add the delete button and form
            echo '<form method="POST">';
            echo '<input type="hidden" name="member_id" value="' . $memberId . '">';
            echo '<button type="submit" name="delete_member">Delete</button>';
            echo '</form>';

            echo '</div>';
            echo '</div>';
        }
    } else {
        // No members found
        echo '<p>No members found.</p>';
    }
    ?>

    </div>
   

    <!-- <?php include '../pages/footer.php'; ?> -->


</body>

</html>
