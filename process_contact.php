<?php
$admin_email = "masomanu23@gmail.com";

$conn = new mysqli("localhost", "root", "", "wcc_site");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$role = $_POST['interest'];
$message = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO contact_messages (full_name, email, phone, role, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $role, $message);

if ($stmt->execute()) {
    // send email notification
    mail($admin_email, "New Contact Message from $name", $message . "\n\nEmail: $email\nPhone: $phone");

    echo "Thank you! Your message has been sent.";
} else {
    echo "Error submitting form.";
}

$stmt->close();
$conn->close();
?>
