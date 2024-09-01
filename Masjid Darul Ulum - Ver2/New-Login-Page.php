<!DOCTYPE html>

<head>
    <link rel="icon" href="MDUMS.ico" type="image/x-icon">
    <link rel="stylesheet" href="login-page-css.css" media="screen">
</head>
<body>

<div class="box">

    <div class="container">

    <div class="left-container">
        <img src="images/283265801_5007701342660530_3462881920272449397_n1.jpg" class="image-right">
    </div>
    <div class="right-container">
        <div class="top-login-container">
            <img src="images/MDUMS.png" class="logo-image" alt="logo">
            <h1>Log Masuk</h1>
            <p>Sila masukkan nama pengguna dan kata laluan</p>
        </div>

        <div class="bottom-login-container">
            <form action="Login-Validation.php" id="login-form" method="POST">

                <div class="col">
                    <label>Nama pengguna</label>
                    <input class="input-login" placeholder="Masukkan nama pengguna" name="username" id="username">
                </div>

                <div class="col"> 
                <label>Kata Laluan</label>
                <input class="input-login" type="password" placeholder="Masukkan kata laluan" name="password" id="password">
                </div>

                <div class="col"> 
                <button class="button-login" name="login" type="submit" form="login-form" id="login">Log Masuk</button>
                </div>

            </form>
        </div>
    </div>

    </div>

</div>

</body>

</html>