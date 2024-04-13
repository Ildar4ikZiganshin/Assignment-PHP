<?php
session_start();
include 'config/dbconfig.php';

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate input
    if (empty($email) || empty($password)) {
        $error_message = "Please enter your email and password.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Check if email and password exist in the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login successful, store user info in session
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            header("Location: member.php");
            exit;
        } else {
            $error_message = "Invalid email or password.";
        }
    }
}
?>

<?php include 'templates/header.php'; ?>

<h2>Welcome to the Final Assignment!</h2>
<p>This is a simple website that demonstrates the use of PHP and MySQL for user management.</p>

<?php if (!isset($_SESSION['email'])) { ?>
    <h3>Login</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
<?php } ?>

<?php include 'templates/footer.php'; ?>
