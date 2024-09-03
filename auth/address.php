<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="personalinfo.css">
    <title>Document</title>
</head>
<body>
    <header>
            <h1 class="logo">Bunae</h1>
    </header>
    <section class="register">
        <form action="#" class="personal-info-form">
            <h2>Address</h2>
            <section class="form-group">
                <label for="street">Street Address</label>
                <input type="text" id="street" required>
            </section>
            <section class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" required>
            </section>
            <section class="form-group">
                <label for="province">Province</label>
                <input type="text" id="province" required>
            </section>
            <section class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" required>
            </section>
            <section class="form-group">
                <a href="register.php">
                <button class="next-button" type="submit"> Next</button>
                </a>
            </section>
        </form>
    </section>
</body>
</html>