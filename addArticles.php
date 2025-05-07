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

        if (isset($_POST["addArticleSubmit"])) {

            $name = $_POST['name'];
            $description = $_POST['description'];

            $sql = "INSERT INTO articles " . "(articleName,articleDes) " . "VALUES('$name','$description')";

            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo "<script>alert('Article Added successfully');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
            }



        }


    }
    ?>

    <div class="addArticles">

        <h1>Add Articles</h1>

        <form action="addArticles.php" method="post">

            <label for="name">Article Name</label>
            <input type="text" name="name" placeholder="Enter Name" required>
            <label for="description">Description</label>
            <textarea placeholder="Text" name="description" required></textarea>
            <input type="submit" value="Add" name="addArticleSubmit">

        </form>

    </div>



</body>

</html>