<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    include("navbar.php");
    $isLoggedIn = isset($_SESSION["user_id"]);

    ?>
    <div class="login">
        <div class="loginContainer">
            <?php if (!$isLoggedIn): ?>
                <div class="loginImg"><img src="images/access-control.png" alt="loginimage"></div>
                <div class="loginContent">
                    <h2>Login</h2>
                    <form action="login.php" method="post">
                        <label for="role">Role</label>
                        <div class="roleSelection">
                            <input type="radio" id="customer" name="role" value="customer" required>
                            <label for="customer">Customer</label>

                            <input type="radio" id="admin" name="role" value="admin" required>
                            <label for="admin">Admin</label>

                            <input type="radio" id="management" name="role" value="management" required>
                            <label for="management">Management</label>
                        </div>
                        <label for="email">Email</label>
                        <input type="email" placeholder="name@gmail.com" name="email" required>
                        <label for="password">Password</label>
                        <input type="password" placeholder="Password" name="password" required>
                        <input type="submit" value="Login" name="loginSubmit">

                    </form>
                    <div class="loginNoAcc">
                        <p>Dont have account?</p>
                        <a href="register.php">Register</a>
                    </div>
                </div>
            <?php else: ?>

                <div class="loginContent">
                    <h2>Welcome, <?= $_SESSION["email"]; ?>!</h2>

                    <a href="login.php?logout=true" class="logoutBtn">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php

    $dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass);
    $db = mysqli_select_db($connect, 'fitzone');



    if (isset($_POST["loginSubmit"])) {
        $role = $_POST["role"];
        $email = $_POST["email"];
        $password = $_POST["password"];


        $table = "";
        if ($role == "customer") {
            $table = "customer";
        } elseif ($role == "admin") {
            $table = "admin";
        } elseif ($role == "management") {
            $table = "management";
        } else {
            echo "<script>alert('Invalid role selected'); window.location.href='login.php';</script>";
            exit();
        }


        $sql = "SELECT * FROM $table WHERE email='$email'";
        $result = mysqli_query($connect, $sql);
        $user = mysqli_fetch_assoc($result);

        if ($user) {

            if (password_verify($password, $user['password'])) {
                if ($role == 'customer') {
                    $_SESSION["user_id"] = $user['cusId'];
                } elseif ($role == 'admin') {
                    $_SESSION["user_id"] = $user['adminId'];
                } elseif ($role == 'management') {
                    $_SESSION["user_id"] = $user['mId'];
                }
                $_SESSION["role"] = $role;
                $_SESSION["email"] = $email;

                if ($role == "customer") {
                    echo "<script>alert('Login successful as customer'); window.location.href='profile.php';</script>";
                    exit();
                } elseif ($role == "admin") {
                    echo "<script>alert('Login successful as admin'); window.location.href='profile.php';</script>";
                    exit();
                } elseif ($role == "management") {
                    echo "<script>alert('Login successful as management'); window.location.href='profile.php';</script>";
                    exit();
                }

            } else {
                echo "<script>alert('Incorrect password'); window.location.href='login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('User not found'); window.location.href='login.php';</script>";
            exit();
        }
    }
    if (isset($_GET["logout"])) {
        session_destroy();
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
    ?>

</body>

</html>