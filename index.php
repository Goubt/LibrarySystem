<!DOCTYPE html>
<link rel='stylesheet' type='text/css' href='Style.css' />
<html>

<head>
    <title>AM Library</title>
</head>

<body>
    <header id="Title">
        AM LIBRARY
    </header>
    <form action="login.php" method="post" id="loginform">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="username" placeholder="User Name"><br>
        <label>Password</label>
        <input type="Password" name="Password" placeholder="Password"><br>
        <button id="loginbutton" type="submit">Login</button>
    </form>
    <a href="register.php">Don't have have a login? Register</a>
    <footer id="footer">
        <p>Site by Aleksey Makarevich 2021</p>
    </footer>
</body>

</html>