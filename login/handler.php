<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Email and password are required"]);
        exit;
    }

    $conn = new mysqli("localhost", "root", "", "userfeedback");

    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => $conn->connect_error]);
        exit;
    }

    //
    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email = ? AND password = ?"
    );
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        echo json_encode([
            "status" => "success",
            "message" => "Login successful"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid email or password"
        ]);
    }
}
?>
