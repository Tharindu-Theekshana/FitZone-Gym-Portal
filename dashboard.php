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
    $role = $_SESSION["role"];
    ?>
    <div class="dashboard">
        <div class="dashboardContainer">
            <div class="dashboardContent">
                <a href="members.php">Members →</a>
                <a href="searchMembers.php">Search Members →</a>
                <a href="addArticles.php">Add Articles →</a>
                <?php if ($role === "admin"): ?>
                    <a href="appointments.php">Appointments →</a>
                    <a href="addAccounts.php">Add Account →</a>
                    <a href="queries.php">Queries →</a>
                <?php endif; ?>
            </div>
            <div class="dashboardTitle">
                <?php if ($role === "admin"): ?>
                    <h1>FitZone</h1>
                    <h2>Admin Panel</h2>
                <?php elseif ($role === "management"): ?>
                    <h1>FitZone</h1>
                    <h2>Management Panel</h2>
                <?php endif; ?>
            </div>

        </div>
    </div>

</body>

</html>