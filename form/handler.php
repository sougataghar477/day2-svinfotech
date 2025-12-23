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
    "db.fr-pari1.bengt.wasmernet.com",
    "a890400970b4800092c62a05eeea",
    "0694a890-4009-71fc-8000-31acc0d66b54",
    "userfeedbacks",
    "10272"
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
