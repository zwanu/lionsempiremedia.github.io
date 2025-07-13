<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $role = htmlspecialchars(trim($_POST["role"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address. Please go back and correct.";
        exit;
    }

    // Prepare email
    $to = "lionsempiremedia@gmail.com";  // Change to your email if needed
    $subject = "New Application from $name via Lions Empire Media Website";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Interested Role: $role\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $name <$email>";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "<h2 style='color:gold;text-align:center;margin-top:50px;'>Thank you, $name! Your application has been sent successfully.</h2>";
        echo "<p style='text-align:center;'><a href='index.html'>Return to Home</a></p>";
    } else {
        echo "Sorry, there was an error sending your application. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>
