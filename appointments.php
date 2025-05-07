<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone</title>
</head>

<body>
    <?php

    include("navbar.php");

    $dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, 'fitzone');

    if (!$connect) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT appointmentId, email, description FROM appointment";
    $result = mysqli_query($connect, $sql);

    ?>

    <div class="appointmentPage">

        <h2>Appointments</h2>
        <table>

            <tr>
                <th>Appointment Id</th>
                <th>Email</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php while ($appointment = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $appointment['appointmentId']; ?> </td>
                    <td><?php echo $appointment['email']; ?> </td>
                    <td><?php echo $appointment['description']; ?> </td>
                    <td> <a class="deleteBtn" href="appointments.php?del=<?php echo $appointment['appointmentId']; ?>"
                            onClick="return confirm('Do you really want to delete?');">Delete</a></td>
                </tr>
            <?php } ?>
        </table>



    </div>

    <?php
    if (isset($_GET['del'])) {
        $appointmentId = $_GET['del'];
        mysqli_query($connect, "DELETE FROM appointment WHERE appointmentId=$appointmentId");
        echo "<script>
        alert('Appointment deleted successfully!');
        window.location.href = 'appointments.php';
         </script>";
        exit();
    }
    ?>


</body>

</html>