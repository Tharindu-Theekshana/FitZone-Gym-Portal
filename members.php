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

    $sql = "SELECT cusId, fName, lName, gender, membershipType, contactNum, email FROM customer";
    $result = mysqli_query($connect, $sql);
    ?>
    <div class="members">
        <div class="customerList">
            <h2>All Customers</h2>
            <table>
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Membership Type</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($customer = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $customer['cusId']; ?></td>
                            <td><?php echo ucwords($customer['fName']); ?></td>
                            <td>

                                <?php echo ucwords($customer['lName']); ?>
                            </td>
                            <td><?php echo ucfirst($customer['gender']); ?></td>
                            <td>
                                <?php echo ucfirst($customer['membershipType']); ?>
                            </td>
                            <td>
                                <?php echo $customer['contactNum']; ?>
                            </td>
                            <td>
                                <?php echo $customer['email']; ?>
                            </td>
                            <td>
                                <a class="deleteBtn" href="members.php?del=<?php echo $customer['cusId']; ?>"
                                    onClick="return confirm('Do you really want to delete?');">Delete</a>
                            </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if (isset($_GET['del'])) {
        $cusId = $_GET['del'];
        mysqli_query($connect, "DELETE FROM customer WHERE cusId=$cusId");
        echo "<script>alert('Customer deleted successfully!');</script>";
        header("Location: members.php");
        exit();
    }

    if (isset($_POST['updateSubmit'])) {
        $cusId = $_POST['cusId'];
        $lName = $_POST['lName'];
        $memType = $_POST['membershipType'];
        $contactNum = $_POST['contactNum'];
        $email = $_POST['email'];

        $updateSql = "UPDATE customer SET lName = '$lName', membershipType = '$memType', contactNum = '$contactNum', email= '$email' WHERE cusId = '$cusId'";

        if (mysqli_query($connect, $updateSql)) {
            "<script>window.location.href='members.php';</script>";
            exit();
        } else {
            echo "Error updating data: " . mysqli_error($connect);
        }
    }
    ?>
</body>

</html>