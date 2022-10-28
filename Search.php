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
        <form action="search.php" method="get" id="searchform">
            <label class="label">Search</label>
            <input type="text" name="search" <br>
            <select name="cat">
                <option disabled selected>-- Select Category --</option>
                <?php
                session_start();
                include "DBCON.php";
                $sql = "SELECT * From category";
                echo "$sql";
                $records = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($records)) {
                    echo "<option value='" . $data['CategoryID'] . "'>"
                        . $data['CategoryDescription'] . "</option>"; // displaying data in option menu
                }
                ?>
            </select>
            <button type="submit" name="submit" value="search">Search</button>
        </form>
        <?php
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        if (isset($_GET['ISBN'])) {
            $ISBN = $_GET['ISBN'];
            $date = date('Y-M-d');
            $username = $_SESSION['Username'];
            $sql = "INSERT INTO `reserved books` (`ISBN`, `Username`, `ReservedDate`)
VALUES ('$ISBN', '$username', '$date')";
            if (mysqli_query($conn, $sql)) {
                echo "Book Reserved";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
            $sql = "UPDATE books SET Reserved='Y' WHERE ISBN='$ISBN'";
            if (mysqli_query($conn, $sql)) {
                echo "";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
        if (isset($_GET['search']) || isset($_GET['cat'])) {
            $count = 0;
            $and_or = isset($_GET["search"]) && isset($_GET["cat"]) ? " AND " : " OR
";
            $cat = "";
            $search = "";
            if (isset($_GET["search"])) {
                if ($_GET['search'] == "") {
                    $search = "books.BookTitle LIKE CONCAT('%%')";
                    $count++;
                } else {
                    // constructs the book title search query
                    $search = "(books.BookTitle LIKE CONCAT('%" . $_GET["search"] . "%')
OR books.Author LIKE CONCAT('%" . $_GET["search"] . "%')) ";
                    // checks if we need to add an and/or symbol
                    if ($count > 0) {
                        $search = $and_or . $search;
                    }
                    $count++;
                }
            }
            if (isset($_GET["cat"])) {
                $cat = "books.CategoryID=" . $_GET["cat"] . " ";
                if ($count > 0) {
                    $cat = $and_or . $cat;
                }
                $count++;
            }
            $sql = "SELECT * FROM books WHERE $search $cat";
            $results_per_page = 5;
            $page_first_result = ($page - 1) * $results_per_page;
            $result = mysqli_query($conn, $sql);
            $number_of_result = mysqli_num_rows($result);
            $number_of_page = ceil($number_of_result / $results_per_page);
            $page_first_result = ($page - 1) * $results_per_page;
            $query = "SELECT * FROM books WHERE $search $cat LIMIT " .
                $page_first_result . ',' . $results_per_page;
            $result = mysqli_query($conn, $query);
            if ($result != false && $result->num_rows > 0) {
                echo "<Table border ='1'>";
                echo "<tr><th>";
                echo ("ISBN");
                echo "</th><th>";
                echo ("BookTitle");
                echo "</th><th>";
                echo ("Author");
                echo "</th><th>";
                echo ("Edition");
                echo "</th><th>";
                echo ("Year");
                echo "</th><th>";
                echo ("CategoryID");
                echo "</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>";
                    echo ($row["ISBN"]);
                    echo "</td><td>";
                    echo ($row["BookTitle"]);
                    echo "</td><td>";
                    echo ($row["Author"]);
                    echo "</td><td>";
                    echo ($row["Edition"]);
                    echo "</td><td>";
                    echo ($row["Year"]);
                    echo "</td><td>";
                    echo ($row["CategoryID"]);
                    echo "</td><td>";
                    //echo ($row["Reserved"]);
                    if ($row["Reserved"] == "Y") {
        ?><button type="button" disabled>Reserve</button><?php
                                                        } else {
                                                            unset($_GET['ISBN']);
                                                            $link = "?" . http_build_query($_GET) . "&ISBN=" . $row['ISBN'];
                                                            ?><a href="search.php<?php echo $link; ?>">Reserve</a><?php
                                                                                                                }
                                                                                                                echo "</td>\n";
                                                                                                            }
                                                                                                        }
                                                                                                        echo "</table>\n";
                                                                                                        unset($_GET['page']);
                                                                                                        for ($page = 1; $page <= $number_of_page; $page++) {
                                                                                                            $link = "?" . http_build_query($_GET) . "&page=" . $page;
                                                                                                            echo '<a href = "search.php' . $link . '">' . "Page " . $page . ' </a>';
                                                                                                        }
                                                                                                    }
                                                                                                                    ?>
        <form method="submit" action="home.php">
            <button id="menu" type="submit">back</button>
        </form>
        <footer id="footer">
            <p>Site by Aleksey Makarevich 2021</p>
        </footer>
    </body>

    </html>