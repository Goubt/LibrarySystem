<?php
session_start();
?>
<!DOCTYPE html>
<link rel='stylesheet' type='text/css' href='Style.css' />

<head>
    <title>AM Library</title>
</head>

<body>
    <header id="Title">
        AM LIBRARY
    </header>
    <h1 class="label">Hello, <?php echo $_SESSION['Firstname']; ?></h1>
    <form method="submit" action="search.php">
        <button id="menu" type="submit">Search Book</button>
    </form>
    <form method="submit" action="reservations.php">
        <button id="menu" type="submit">My Reservations</button>
    </form>
    <form method="submit" action="logout.php">
        <button id="menu" type="submit">Logout</button>
    </form>
    <footer id="footer">
        <p>Site by Aleksey Makarevich 2021</p>
    </footer>
</body>

</html>