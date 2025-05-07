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
    $dbhost = 'localhost';
    $dbuser = '';
    $dbpass = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass);
    $db = mysqli_select_db($connect, 'fitzone');



    $result = null;
    if (isset($_POST['searchArticle'])) {
        $search = mysqli_real_escape_string($connect, $_POST['searchInput']);
        $sql = "SELECT * FROM articles WHERE articleName = '$search'";
        $result = mysqli_query($connect, $sql);

        $searchInput = $_POST['searchInput'];

        if (!$result) {
            die("Query failed: " . mysqli_error($connect));
        }
    }

    ?>
    <div class="searchAricles">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {

            $article = mysqli_fetch_array($result);
            ?>

            <h2>result found for search " <?php echo $searchInput ?> "</h2>
            <p><?php echo $article['articleDes']; ?></p>


            <?php
        } else {
            ?>
            <h2> No result found for search " <?php echo $searchInput ?> " 🔎</h2> <?php
        }
        ?>
    </div>


</body>

</html>