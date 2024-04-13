<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Final Assignment</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="container">
        <header id="banner">
            <h1>Final Assignment</h1>
            <h3>Users' Info Using PHP with MySQL</h3>
        </header>
        <div id="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['email'])) { ?>
                    <li><a href="member.php">Member</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="main-content">
