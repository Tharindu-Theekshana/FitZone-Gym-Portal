<?php

$dbhost = 'localhost';
$dbuser = '';
$dbpass = '';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$connect) {
    die('Could not connect: ' . mysqli_error($conn));
}
echo "<script>alert('database connected!');</script>";


$db = mysqli_select_db($connect, 'fitzone');

if (!$db) {

    echo 'Select database first ';

} else
    echo "<script>alert('database selected!');</script>";
;


if (isset($_POST["btnSubmit"])) {

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $gender = $_POST['gender'];
    $memType = $_POST['memType'];
    $contactNum = $_POST['contactNum'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO customer " . "(fName,lName,gender,membershipType,contactNum,email,password) " . "VALUES('$fName','$lName','$gender','$memType','$contactNum','$email','$password')";

    $results = mysqli_query($connect, $sql);
    if (!$results) {
        die('Could not enter data: ' . mysqli_error($connect));
    } else {
        echo "Entered data successfully\n";
    }

}






?>