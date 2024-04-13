<?php
session_start();
include 'config/dbconfig.php';

// Process contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate input
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "Please fill in all the fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Send email (optional)
        $to = "your_email@example.com";
        $subject = "New message from your website";
        $body = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email";
        if (mail($to, $subject, $body, $headers)) {
            $success_message = "Your message has been sent successfully.";
        } else {
            $error_message = "An error occurred while sending the message.";
        }
    }
}
?>

<?php include 'templates/header.php'; ?>

<h2>Contact Us</h2>
<p>Please fill in the contact form to send us a message.</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    <input type="submit" value="Submit">
</form>

<?php if (isset($error_message)) { ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php } elseif (isset($success_message)) { ?>
    <p style="color: green;"><?php echo $success_message; ?></p>
<?php } ?>

<?php include 'templates/footer.php'; ?>
