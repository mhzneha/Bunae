<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/contact.css">
    <title>contact</title>
</head>
<body>
    <?php @include 'navbar.php'?>
    <section class="contacts">
        <h1>Contact Us</h1>
    </section>
    <div class="contact-container">
        <section class="contact">
            <i class='bx bx-phone'> 9864474281</i>
            <i class='bx bx-envelope'> nehamaharjan@gmail.com</i>
            <i class='bx bxs-edit-location'> Gwarko, Lalitpur</i>
        </section>
        <section class="user-form">
            <form action="" method="post">
                <h2>Contact Form</h2>
                <section class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your Names" required>
                </section>
                <section class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Email" required>
                </section>
                <section class="form-group">
                    <label for="message">Your Message</label>
                    <textarea name="message" class="box" placeholder="Enter your message" required cols="30"
                    rows="10"></textarea>
                </section>
                <section class="form-group">
                    <button class="send" type="submit" name="send">Send</button>
                </section>
            </form>
        </section>
    </div>
</body>
</html>