<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/custom-styles.css">
    <title>Matatu Sacco - Routes</title>
    <style>

        /* Reset some default styles */
body, h1, h2, p, table {
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}


h2 {
    color: #006266;
    margin-bottom: 10px;
}

.routes-table {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
}

th {
    background-color: #006266;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

    </style>
</head>
<body>

<?php include 'dbconnect.php'; ?>
<?php include 'header.php'; ?>


    <section id="routes">
        <h2>Routes</h2>
        <div class="routes-table">
            <?php
            $query = "SELECT * FROM routes";
            $result = $db->query($query);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Route ID</th><th>Route Name</th><th>Start Location</th><th>End Location</th><th>Distance (km)</th><th>Cost</th><th>Actions</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['route_id'] . "</td>";
                    echo "<td>" . $row['route_name'] . "</td>";
                    echo "<td>" . $row['start_location'] . "</td>";
                    echo "<td>" . $row['end_location'] . "</td>";
                    echo "<td>" . $row['distance'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";

                    echo "<td><a class='book-button' href='bookings.php?route_id=" . $row['route_id'] . "'>Book</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No routes found.";
            }

            $db->close();
            ?>
        </div>
    </section>

 
</div>

</body>
</html>
