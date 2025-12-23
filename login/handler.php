<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Email and password are required"]);
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
        echo json_encode(["status" => "error", "message" => $conn->connect_error]);
        exit;
    }

    $stmt = $conn->prepare(
        "SELECT id FROM users WHERE email = ? AND password = ?"
    );
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

         
        $_SESSION['admin_id'] = true;

        echo json_encode([
            "status" => "success",
            "message" => "Login successful"
        ]);
        exit;

    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid email or password"
        ]);
        exit;
    }
}
