<?php

@include 'db.php';

if (isset($_POST['submit'])) {
    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'User already exists!';
    } else {
        if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $pass)) {
            $message[] = 'Password must be at least 8 characters long and contain letters and numbers.';
        } elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9]*\d$/', $name)) {
            $message[] = 'Username must start with a letter and end with a number.';
        } else {
            // $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
            mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
            $message[] = 'Registered successfully!';
            header('location:login.php');
            exit();
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
    <title>Document</title>
</head>
<body>
<?php
if(isset($message)){
    foreach ($message as $msg) {
        echo '
            <div class="message">
            <span>' . htmlspecialchars($msg) . '</span>
            // <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
            </div>';
    }
    
}
?>
    <header>
            <h1 class="logo">Bunae</h1>
    </header>
    <div class="register">
        <form action="#" class="signup-form" method="post">
                <h2>SIGN IN</h2>
                <section class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </section>
                <section class="form-group">
                    <label for="email">email</label>
                    <input type="text" id="email" name="email" required>
                </section>
                <section class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" required>
                </section>
                <!-- <section class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" required>
                </section> -->
                <section class="form-group">
                    <button class="signup-button" type="submit" name="submit">Register</button>
                </section>
                <section class="form-group">
                    <p>Already have an accout?</p>
                    <a href="login.php"><p>Sign In</p></a>
                </section>
            </form>
        </div>
</body>
</html>


