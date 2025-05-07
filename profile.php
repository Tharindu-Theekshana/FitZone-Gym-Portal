<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("navbar.php");

    $isLoggedIn = isset($_SESSION["user_id"]);

    $dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, 'fitzone');

    if (!$connect) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $user_id = $_SESSION["user_id"];
    $role = $_SESSION["role"];

    if ($role === "customer") {
        $table = "customer";
        $id_field = "cusId";
        $fields = "cusId, fName, lName, gender, membershipType, contactNum, email";

    } elseif ($role === "admin") {
        $table = "admin";
        $id_field = "adminId";
        $fields = "adminId, name, email";
    } elseif ($role === "management") {
        $table = "management";
        $id_field = "mId";
        $fields = "mId, name, email";
    } else {
        echo "<script>alert('Invalid user role!'); window.location.href='login.php';</script>";
        exit();
    }


    $sql = "SELECT $fields FROM $table WHERE $id_field = '$user_id'";
    $result = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
        exit();
    }
    if ($role === "customer") {
        $customerId = $user['cusId'];
    }

    if (isset($_POST["queriesSubmit"])) {

        $description = $_POST['description'];

        $sql = "INSERT INTO queries " . "(cusId,description) " . "VALUES('$customerId','$description')";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo "<script>alert('Queries sended successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
        }
    }
    ?>

    <div class="profile">
        <h1>Welcome,
            <?php echo ucfirst(htmlspecialchars($user[$role === "customer" ? "fName" : ($role === "admin" ? "name" : "name")])); ?>!
        </h1>

        <div class="profileContainer">
            <img src="images/profile.png" alt="profileimg">
            <div class="profileContent">
                <table>
                    <?php if ($role === "customer"): ?>

                        <tr>
                            <td>Member ID</td>
                            <td><?php echo $user['cusId']; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo ucwords($user['fName'] . " " . $user['lName']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo ucfirst($user['gender']); ?></td>
                        </tr>
                        <tr>
                            <td>Membership Type</td>
                            <td><?php echo ucfirst($user['membershipType'] . " membership"); ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td><?php echo $user['contactNum']; ?></td>
                        </tr>






                    <?php elseif ($role === "admin"): ?>
                        <tr>
                            <td>Admin ID</td>
                            <td><?php echo $user['adminId']; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo ucfirst($user['name']); ?></td>
                        </tr>

                    <?php elseif ($role === "management"): ?>
                        <tr>
                            <td>Manager ID</td>
                            <td> <?php echo $user['mId']; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo ucfirst($user['name']); ?></td>
                        </tr>

                    <?php endif; ?>

                    <tr>
                        <td>Email</td>
                        <td><?php echo $user['email']; ?></td>
                    </tr>
                </table>

                <?php if ($role === "customer"): ?>

                    <div class="sendQueries">
                        <h2>Send Queries to the Management</h2>
                        <form action="profile.php" method="post">

                            <label for="description">Description</label>
                            <textarea placeholder="Text" name="description" required></textarea>
                            <input type="submit" value="Send" name="queriesSubmit">

                        </form>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>