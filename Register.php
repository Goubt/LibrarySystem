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
    <form action="registration.php" method="post" id="loginform">
        <h2>Register</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="username" placeholder="User Name"><br>
        <label>Password</label>
        <input type="Password" name="password" placeholder="Password"><br>
        <label>Confirm Password</label>
        <input type="Password" name="conpassword" placeholder="Confirm
Password"><br>
        <label>First Name</label>
        <input type="text" name="firstname" placeholder="First Name"><br>
        <label>Last Name</label>
        <input type="text" name="lastname" placeholder="Last Name"><br>
        <label>Address Line 1</label>
        <input type="text" name="addy1" placeholder="Address Line 1"><br>
        <label>Address Line 2</label>
        <input type="text" name="addy2" placeholder="Address Line 2"><br>
        <label>City</label>
        <input type="text" name="city" placeholder="City"><br>
        <label>Telephone</label>
        <input type="number" name="telly" placeholder="Telephone"><br>
        <label>Mobile</label>
        <input type="number" name="mobile" placeholder="Mobile"><br>
        <button id="loginbutton" type="submit">Register</button>
    </form>
    <a href="login.php">Already registered? Login</a>
    <footer id="footer">
        <p>Site by Aleksey Makarevich 2021</p>
    </footer>
</body>

</html>