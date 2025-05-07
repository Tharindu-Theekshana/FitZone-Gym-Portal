<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    include("navbar.php");

    $dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass);
    if (!$connect) {
        die('Could not connect: ' . mysqli_error($conn));
    }



    $db = mysqli_select_db($connect, 'fitzone');

    if (!$db) {

        echo "<script>alert('database select first!');</script>";

    } else

        if (isset($_POST["appointmentSubmit"])) {

            $email = $_POST['email'];
            $description = $_POST['description'];

            $sql = "INSERT INTO appointment " . "(email,description) " . "VALUES('$email','$description')";

            $results = mysqli_query($connect, $sql);
            if (!$results) {
                die('Could not enter data: ' . mysqli_error($connect));
            } else {
                echo "<script>alert('Appointment submited successfully! we will catch you.');</script>";
            }

        }

    ?>
    <div class="contact">

        <h1>Get in touch with us</h1>
        <p>Have questions or ready to start your fitness journey? Contact FitZone Fitness Center today! Our team is here
            to guide you with expert advice, personalized training, and top-notch facilities. Call, email, or visit us
            to take the first step toward a healthier, stronger you! 💪📞</p>

        <div class="contactContainer">
            <div class="contactBox">
                <img src="images/support_2268705.png" alt="call">
                <h4>Give us a call ☎️</h4>
                <p>0767696411 📞</p>
                <p>From Monday to Sunday 7.00am to 10.00pm ✔️</p>
            </div>
            <div class="contactBox">
                <img src="images/message_7884167.png" alt="email">
                <h4>Email Us ✉️</h4>
                <p>FitZone@gmail.com </p>
                <p>We will reply to your email asap ✔️</p>
            </div>
            <div class="contactBox">
                <img src="images/mosque_6684665.png" alt="location">
                <h4>Visit Us 📍</h4>
                <p>Kurunegala </p>
                <p>Appointments only ✔️</p>
            </div>
        </div>
        <h2>Scroll to make appointment ↓</h2>
    </div>
    <div class="appointmentCont">
        <h1>Make appointment</h1>

        <div class="appointment">
            <form action="contact.php" method="post">
                <label for="email">Email</label>
                <input type="email" placeholder="name@gmail.com" name="email" required />
                <label for="description">Description</label>
                <input type="text" placeholder="Text" name="description" />
                <input type="submit" name="appointmentSubmit">
            </form>
        </div>


    </div>

</body>

</html>