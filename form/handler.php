<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$subject   = trim($_POST['subject'] ?? '');
$message   = trim($_POST['message'] ?? '');

if (!$full_name || !$email || !$subject || !$message) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

$conn = new mysqli(
    "sql111.infinityfree.com",
    "if0_40745702",
    "Lde3v7vF3XwHcc4",
    "if0_40745702_userfeedbacks"
);

if ($conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => $conn->connect_error
    ]);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO feedbacks (full_name, email, subject, message)
     VALUES (?, ?, ?, ?)"
);

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("ssss", $full_name, $email, $subject, $message);

if (!$stmt->execute()) {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
    exit;
}

echo json_encode(["status" => "success", "message" => "Feedback submitted"]);
