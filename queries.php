<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    $sql = "SELECT querieId, cusId, description FROM queries";
    $result = mysqli_query($connect, $sql);

    ?>
    <div class="queries">

        <h1>Queries</h1>

        <table>
            <thead>
                <tr>
                    <th>Query ID</th>
                    <th>Customer ID</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($querie = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $querie['querieId']; ?></td>
                        <td><?php echo $querie['cusId']; ?></td>
                        <td><?php echo $querie['description']; ?></td>
                        <td><a class="deleteBtn" href="queries.php?del=<?php echo $querie['querieId']; ?>"
                                onClick="return confirm('Do you really want to delete?');">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <?php
    if (isset($_GET['del'])) {
        $querieId = $_GET['del'];
        mysqli_query($connect, "DELETE FROM queries WHERE querieId=$querieId");
        echo "<script> alert('Query deleted successfully!');
        window.location.href = 'queries.php'; </script>";
        exit();
    }
    ?>

</body>

</html>