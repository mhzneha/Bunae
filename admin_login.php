<?php

@include 'db.php'; 
session_start();

if (isset($_POST['submit'])) {

    // Sanitize and escape the input values
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_pass);

    // Check if there are any admins in the database
    $check_admins = mysqli_query($conn, "SELECT * FROM `admin`") or die('Query failed');
    if (mysqli_num_rows($check_admins) === 0) {
        $message[] = 'No admin found!';
    } else {
        // Query to find the admin with the given email and password
        $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$password'") or die('Query failed');
        
        if (mysqli_num_rows($select_users) > 0) {
            $row = mysqli_fetch_assoc($select_users);

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } else {
            $message[] = 'Incorrect email or password!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Admin login</title>
</head>
<body>
    <header>
        <h1 class="logo">Bunae</h1>
    </header>
    <div class="login-form">
        
        <?php
            if (!empty($message)) {
                foreach ($message as $msg) {
                    echo '<div class="msg">
                            <span>' . $msg . '</span>
                            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
                        </div>';
                }
            }
        ?>

        <form action="#" class="signin-form" method="post">
            <h2>ADMIN SIGN IN</h2>
            <section class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </section>
            <section class="form-group">
                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" required>
            </section>
            <section class="form-group">
                <button class="signup-button" type="submit" name="submit">Login as Admin</button>
            </section>
        </form>
    </div>   
</body>
</html>