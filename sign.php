<?php
include_once 'dbConnection.php';
ob_start();

$name = ucwords(strtolower(addslashes(stripslashes($_POST['name']))));
$gender = addslashes(stripslashes($_POST['gender']));
$email = addslashes(stripslashes($_POST['email']));
$college = addslashes(stripslashes($_POST['college']));
$mob = addslashes(stripslashes($_POST['mob']));
$password = md5(addslashes(stripslashes($_POST['password'])));

// Check if email already exists
$check = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");

if (mysqli_num_rows($check) > 0) {
    // Email already registered
    header("location:index.php?q7=Email Already Registered!!!");
} else {
    // Use explicit column names for safety
    $q3 = mysqli_query($con, "INSERT INTO user (name, gender, college, email, mob, password) 
                              VALUES ('$name', '$gender', '$college', '$email', '$mob', '$password')");
    
    if ($q3) {
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $name;
        header("location:account.php?q=1");
    } else {
        header("location:index.php?q7=Registration failed. Try again.");
    }
}

ob_end_flush();
?>
