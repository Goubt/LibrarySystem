<?php
session_start();
include "DBCON.php";
if (isset($_POST['username']) && isset($_POST['Password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $pass = validate($_POST['Password']);
    if (empty($username)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE Username='$username' AND
Password='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (
                $row['Username'] === $username && $row['Password']
                === $pass
            ) {
                echo "Logged in!";
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['Firstname'] = $row['Firstname'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect User
name or Password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect User name
or Password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
