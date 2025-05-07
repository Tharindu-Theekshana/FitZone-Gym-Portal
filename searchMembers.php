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

    $result = null;
    if (isset($_POST['searchSubmit'])) {
        $search = mysqli_real_escape_string($connect, $_POST['cusId']);
        $sql = "SELECT * FROM customer WHERE cusId = '$search'";
        $result = mysqli_query($connect, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($connect));
        }
    }
    if (isset($_POST['update'])) {
        $cusId = $_POST['cusId'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $memType = $_POST['memType'];
        $contactNum = $_POST['contactNum'];
        $email = $_POST['email'];


        $updateSql = "UPDATE customer SET lName = '$lName',membershipType = '$memType',contactNum = '$contactNum', email = '$email' WHERE cusId = '$cusId'";

        if (mysqli_query($connect, $updateSql)) {
            echo "<script>alert('Member details updated successfully!'); window.location.href='members.php';</script>";



            exit();
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    }

    ?>
    <div class="searchMembers">

        <div class="searchMembersContainer">
            <h2>Enter member id to search and update</h2>
            <form method="post" action="searchMembers.php">
                <label for="cusId">Member Id</label>
                <input type="text" name="cusId" placeholder="Enter member id to search and update" required />
                <input type="submit" value="Search" name="searchSubmit" />
            </form>

        </div>


    </div>
    <div class="updateMembers">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {

            $customer = mysqli_fetch_array($result);
            ?>

            <table>

                <thead>
                    <tr>
                        <th>Member Id</th>
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
                    <tr>
                        <form method="post" action="searchMembers.php">
                            <input type="hidden" name="cusId" value="<?php echo $customer['cusId']; ?>" />

                            <td><?php echo $customer['cusId']; ?></td>
                            <td>
                                <input type="hidden" name="fName" value="<?php echo $customer['fName']; ?>" />
                                <?php echo $customer['fName']; ?>
                            </td>
                            <td>
                                <input type="text" name="lName" value="<?php echo $customer['lName']; ?>" />
                            </td>
                            <td><?php echo $customer['gender']; ?></td>
                            <td>
                                <select name="memType" id="memType" value="<?php echo $customer['lName']; ?>">
                                    <option value="basic">Basic Membershp</option>
                                    <option value="standard">Standard Membershp</option>
                                    <option value="premium">Premium Membershp</option>
                                    <option value="elite">Elite Membershp</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="contactNum" value="<?php echo $customer['contactNum']; ?>" />
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $customer['email']; ?>" />
                            </td>
                            <td>
                                <button class="updateBtn" type="submit" name="update">Update</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <?php
        } else {
            echo "No customer found with that customer id ";


        }
        ?>
    </div>


</body>

</html>