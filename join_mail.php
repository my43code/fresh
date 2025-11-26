<?php
$admin_email = "masomanu23@gmail.com";

$conn = new mysqli("localhost", "root", "", "wcc_site");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['newsletter-email'];

$stmt = $conn->prepare("INSERT INTO mailing_list (email) VALUES (?)");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    mail($admin_email, "New Mailing List Subscriber", "Email: $email");
    echo "You have been successfully subscribed!";
} else {
    echo "You are already subscribed.";
}

$stmt->close();
$conn->close();
?>
