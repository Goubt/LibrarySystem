<!DOCTYPE html>
<link rel='stylesheet' type='text/css' href='Style.css' />

<head>
    <title>AM Library</title>
</head>

<body>
    <header id="Title">
        AM LIBRARY
    </header>

    <body>
        <?php
        session_start();
        include "DBCON.php";
        if (isset($_GET['ISBN'])) {
            $ISBN = $_GET['ISBN'];
            $username = $_SESSION['Username'];
            $sql = "DELETE FROM `reserved books` WHERE ISBN='$ISBN'";
            if (mysqli_query($conn, $sql)) {
                echo "Reservation removed";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
            $sql = "UPDATE books SET Reserved='N' WHERE ISBN='$ISBN'";
            if (mysqli_query($conn, $sql)) {
                echo "";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
        $username = $_SESSION['Username'];
        $sql = "SELECT * FROM `reserved books` WHERE Username='$username'";
        $result = $conn->query($sql);
        if ($result != false && $result->num_rows > 0) {
        ?><label>My Reservations</label><?php
                                        echo "<Table border ='1'>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr><td>";
                                            echo ($row["ISBN"]);
                                            echo "</td><td>";
                                            echo ($row["Username"]);
                                            echo "</td><td>";
                                            echo ($row["ReservedDate"]);
                                            echo "</td><td>";
                                            unset($_GET['ISBN']);
                                            $link = "?" . http_build_query($_GET) . "&ISBN=" . $row['ISBN'];
                                        ?><a href="reservations.php<?php echo $link; ?>">Remove
                    Reservation</a><?php
                                            echo "</td>\n";
                                        }
                                    } else {
                                    ?><label class="label">You have no reservations</label><?php
                                                                                        }
                                                                                        echo "</table>\n";
                                                                                            ?>
        <form method="submit" action="home.php">
            <button id="menu" type="submit">back</button>
        </form>
        <footer id="footer">
            <p>Site by Aleksey Makarevich 2021</p>
        </footer>
    </body>

    </html>