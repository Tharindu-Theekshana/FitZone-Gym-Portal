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
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass);
    if (!$connect) {
        die('Could not connect: ' . mysqli_error($conn));
    }



    $db = mysqli_select_db($connect, 'fitzone');

    if (!$db) {

        echo "<script>alert('database select first!');</script>";

    } else {

        if (isset($_POST["addAccountSubmit"])) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            if ($role == "admin") {
                $sql = "INSERT INTO admin " . "(name,email,password) " . "VALUES('$name','$email','$hashedPassword')";
            } elseif ($role == "manager") {
                $sql = "INSERT INTO management " . "(name,email,password) " . "VALUES('$name','$email','$hashedPassword')";
            }

            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo "<script>alert('Account created successfully');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
            }



        }


    }
    ?>

    <div class="addAccount">

        <h1>Create Account</h1>

        <form action="addAccounts.php" method="post">
            <label for="role">Role</label>
            <div class="radioRole">

                <input type="radio" id="admin" name="role" value="admin" required>
                <label for="admin">Admin</label>

                <input type="radio" id="manager" name="role" value="manager" required>
                <label for="manager">Manager</label>
            </div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Enter Name" required>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="name@gmail.com" required>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" value="Create Account" name="addAccountSubmit">

        </form>

    </div>

</body>

</html>