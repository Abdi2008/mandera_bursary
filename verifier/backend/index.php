<?php
include_once("../../admin/includes/header.php");

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email    = $_POST['email'];
    $password = MD5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM university_admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Store verifier info in session
        $_SESSION['verifier_id']   = $row['id'];
        $_SESSION['verifier_name'] = $row['university_name'];
        header("Location: ../dashboard.php");
        exit();
    } else {
        header("Location: ../index.php?message=Invalid email or password");
        exit();
    }
} else {
    header("Location: ../index.php?message=Please fill in all fields");
    exit();
}
?>
