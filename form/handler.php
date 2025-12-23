<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$subject   = trim($_POST['subject'] ?? '');
$message   = trim($_POST['message'] ?? '');

if (empty($full_name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

$conn = new mysqli(
    "sql111.infinityfree.com",
    "if0_40745702",
    "Lde3v7vF3XwHcc4",
    "if0_40745702_userfeedbacks",
    3306
);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO feedbacks (full_name, email, subject, message) VALUES (?, ?, ?, ?)"
);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Prepare failed"]);
    exit;
}

$stmt->bind_param("ssss", $full_name, $email, $subject, $message);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Feedback submitted"]);
} else {
    echo json_encode(["status" => "error", "message" => "Insert failed"]);
}

$stmt->close();
$conn->close();
