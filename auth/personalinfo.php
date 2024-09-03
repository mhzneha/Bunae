<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="personalinfo.css">
</head>
<body>
    <header>
        <h1 class="logo">Bunae</h1>        
    </header>
    <div class="register">
        <form action="#" class="personal-info-form">

           
            <section class="form-group">
            <h2>Persnal Infromation</h2>
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" required>
            </section>
            <section class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" required>
            </section>
            <section class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" required>
            </section>
            <section class="form-group">
                <label for="phone">Phone No.</label>
                <input type="text" id="phone" required>
            </section>
            <section class="form-group">
                <a href="address.php">
                <button class="next-button" type="submit"> Next</button>
                </a>
            </section>
        </form>
    </div>
</body>
</html>