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

    ?>
    <div class="formBackground">
        <div class="banner">
            <h1>Join The FitZone</h1>
        </div>

        <div class="formContainer">
            <form action="register.php" method="post">
                <label for="fName">First Name</label>
                <input type="text" placeholder="Enter First Name" id="fName" name="fName" required>
                <label for="lName">Last Name</label>
                <input type="text" placeholder="Enter Last Name" id="lName" name="lName" required>
                <label for="gender">Gender</label>
                <div>
                    <label for="male">Male</label>
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="female">Female</label>
                    <input type="radio" id="female" name="gender" value="female" required>
                </div>
                <label for="memType">Membership Plan</label>
                <select name="memType" id="memType" required>
                    <option value="basic">Basic Membershp</option>
                    <option value="standard">Standard Membershp</option>
                    <option value="premium">Premium Membershp</option>
                    <option value="elite">Elite Membershp</option>
                </select>
                <label for="contactNum">Contact Number</label>
                <input type="tel" placeholder="Enter Contact Number" id="contactNum" name="contactNum" required>
                <label for="email">Email</label>
                <input type="email" placeholder="Name@gmail.com" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" placeholder="Enter Password..." id="password" name="password" required>
                <input type="submit" value="Register" name="btnSubmit">

            </form>
        </div>
    </div>
    <?php

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




        if (isset($_POST["btnSubmit"])) {

            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $gender = $_POST['gender'];
            $memType = $_POST['memType'];
            $contactNum = $_POST['contactNum'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO customer " . "(fName,lName,gender,membershipType,contactNum,email,password) " . "VALUES('$fName','$lName','$gender','$memType','$contactNum','$email','$hashedPassword')";

            $results = mysqli_query($connect, $sql);
            if (!$results) {
                die('Could not enter data: ' . mysqli_error($connect));
            } else {
                echo "<script>alert('Registered successfully! now you can login.');</script>";
            }

        }






    ?>
</body>

</html>