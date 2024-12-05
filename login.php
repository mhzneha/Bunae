<?php

@include 'db.php';

session_start();

if(isset($_POST['submit'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, ($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:homepage.php');

      }else{
         $message[] = 'no user found!';
      }
   }else{
      $message[] = 'incorrect email or password!';
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
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
    

<?php
if (!empty($message)) {
    foreach ($message as $msg) {
        echo '
        <div class ="msg">
            <span>'.$msg.'</span>
            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

    <header>
        <h1 class="logo">Bunae</h1>
    </header>
    <div class="login-form">
            
    <form action="#" class="signin-form" method="post">
    <h2>SIGN IN</h2>
    <section class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </section>
    <section class="form-group">
        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass" required>
    </section>
    <section class="form-group">
        <button class="signup-button" type="submit" name="submit">Login</button>
    </section>
    <section class="form-group">
        <p>Don't have an account?</p>
        <a href="register.php"><p>Sign Up</p></a>
    </section>
</form>

    </div>
</body>
</html>