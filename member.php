<?php
session_start();
include 'config/dbconfig.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
?>

<?php include 'templates/header.php'; ?>

<h2>Welcome, <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>!</h2>
<p>Your email address is: <?php echo $_SESSION['email']; ?></p>

<p>This is the member page. Add your additional content here.</p>

<?php include 'templates/footer.php'; ?>
