<?php
session_start();
include "DBCON.php";
if (
    isset($_POST['username']) && isset($_POST['password']) &&
    isset($_POST['conpassword']) && isset($_POST['firstname']) &&
    isset($_POST['lastname']) && isset($_POST['addy1']) && isset($_POST['addy2'])
    && isset($_POST['city']) && isset($_POST['telly']) &&
    isset($_POST['mobile'])
) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $conpass = validate($_POST['conpassword']);
    $first = validate($_POST['firstname']);
    $last = validate($_POST['lastname']);
    $addy1 = validate($_POST['addy1']);
    $addy2 = validate($_POST['addy2']);
    $city = validate($_POST['city']);
    $telly = validate($_POST['telly']);
    $mobile = validate($_POST['mobile']);
    if (empty($username)) {
        header("Location: register.php?error=User Name is
required");
        exit();
    } else if (empty($pass) || strlen($pass) != 6) {
        header("Location: register.php?error=Valid Password is
required");
        exit();
    } else if (strcmp($pass, $conpass) !== 0) {
        header("Location: register.php?error=Passwords do not
match");
        exit();
    } else if (empty($first)) {
        header("Location: register.php?error=First Name is
required");
        exit();
    } else if (empty($last)) {
        header("Location: register.php?error=Last Name is
required");
        exit();
    } else if (empty($addy1)) {
        header("Location: register.php?error=Address Line 1 is
required");
        exit();
    } else if (empty($addy2)) {
        header("Location: register.php?error=Address Line 2 is
required");
        exit();
    } else if (empty($city)) {
        header("Location: register.php?error=City is required");
        exit();
    } else if (empty($telly)) {
        header("Location: register.php?error=Telephone Number is
required");
        exit();
    } else if (empty($mobile) || strlen($mobile) != 10) {
        header("Location: register.php?error=Valid Mobile Number
is required");
        exit();
    } else {
        $sql = "INSERT INTO users (Username, Password, Firstname,
Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) VALUES
('$username', '$pass', '$first', '$last', '$addy1', '$addy2', '$city',
'$telly', '$mobile')";
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php");
        } else {
            header("Location: register.php?error=Sorry there's
been an error with our servers.");
        }
    }
} else {
    header("Location: register.php");
    exit();
}
