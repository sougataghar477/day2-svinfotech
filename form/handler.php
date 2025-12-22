<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    if(empty($full_name) || empty($email) || empty($subject) || empty($message)){
        json_encode(["status" => "error", "message" =>"All fields are required"]);
    }   
    // Connect to MySQL
    $conn = new mysqli("localhost", "root", "", "userfeedback");

    if ($conn->connect_error) {
        // Connection failed → return JSON error and stop execution
        echo json_encode(["status" => "error", "message" => $conn->connect_error]);
        exit;
    }

    // Connection successful
    else{
        $stmt = $conn->prepare("INSERT INTO feedbacks (full_name, email, subject,message) VALUES (?, ?, ?, ?)");
        if($stmt){
            $stmt->bind_param("ssss", $full_name, $email, $subject,$message);
            if($stmt->execute()){
                echo json_encode(["status" => "success", "message" => "Inserted successfully"]);
            }
            else{
                echo json_encode(["status" => "failure", "message" => "Insert failed because execution failed"]);
            }
        }
        else{
            echo json_encode(["status" => "failure", "message" => "Insert failed because preparation failed"]); 
        }
    }
}
?>