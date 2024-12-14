<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matatu Sacco App</title>

    <link rel="stylesheet" href="../css/custom-styles.css">
    
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

        section {
      max-width: 800px;
      margin: 10px auto;
      padding: 1rem;
      background-color: #079992;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

    }


    section h2 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
    }

    section p {
      font-size: 1.1rem;
      margin-bottom: 1rem;
    }

    .cta-button {
      display: block;
      text-align: center;
      margin-top: 1rem;
      padding: 0.8rem 1.5rem;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .cta-button:hover {
      background-color: #0056b3;
    }
    </style>

</head>
</body>
<?php include '../pages/header.php'; ?>
 

<section id="routes">
    <h2>Routes</h2>
    <p>Find information about the different matatu routes covered by our Sacco. Plan your journeys efficiently and get to your destination safely.</p>
    <a class="cta-button" href="view_routes.php">View Routes</a>
  </section>
 

  <section id="contact">
    <h2>Contact Us</h2>
    <p>If you have any questions or feedback, feel free to get in touch with our customer support team. We are here to assist you.</p>
    <a class="cta-button" href="#">Contact Support</a>
  </section>


</body>
</html>
