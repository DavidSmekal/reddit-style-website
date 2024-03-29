<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/topics.css">
    <title>Homepage</title>
</head>

<body>
    <ul>
        <li><a href="homepage.php">Home</a></li>
        <li><a href="topic1.php">Liberal</a></li>
        <li><a href="topic2.php">Libertarian</a></li>
        <li><a href="topic3.php">Conservative</a></li>
        <?php if(isset($_SESSION['username'])){ ?>
            <li class="float_right"><a href="php/loginScript.php?action=logout">Logout</a></li>
        <?php }else{ ?>
            <li class="float_right"><a href="login.php">Login</a></li>
        <?php } ?>
        <li class="float_right"><a href="profile.php">Profile</a></li>
        <li class="float_right"><a href="makepost.php">Make Post</a></li>
        <?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){ ?>
            <li class="float_right"><a href="administratorPage.php">Administrator</a></li>
        <?php } ?>
    </ul>
    <div id="headline">
        <h1>Popular: Trending Content</h1>
    </div>
    <!-- This is where the body of the page will be -->
    <div class="page_body">


        <?php

// this is going to populate the front page with 6 random posts - 2 from each board
        $host = "localhost";
        $database = "finalproject360";
        $user = "root";
        $password = "";

        $connection = mysqli_connect($host, $user, $password, $database);

        $error = mysqli_connect_error();
        if($error != null)
        {
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
        }
        else
        {

            $sql2 = "SELECT * FROM blogpost1  UNION SELECT * FROM blogpost2 UNION SELECT * FROM blogpost3 ORDER BY vote DESC limit 6";

            $results2 = mysqli_query($connection, $sql2);

            echo '<br>';
            echo '<br>';

            while ($row2 = mysqli_fetch_assoc($results2)){

                $title = $row2['title'];
                $content = $row2['content'];
                $date = $row2['date'];
                $username = $row2['username'];
                $postID = $row2['postID'];
                $postVote = $row2['vote'];


                echo '<div id="topOfDiv">';
                echo "<a href=\"#\">$username</a>&nbsp;&nbsp;";
                echo "<br><p>Posted: $date</p>";
                echo '</div>';

                echo "<div id=\"placeholder_for_content\">";
                echo "<div class=inlineBlock>";
                echo "<h1>$postVote</h1>";
                echo "</div>";
                echo "<div class='inlineBlock centered'>";
                echo "<p><a href=\"#\">$title</a></p>";
                echo "<p>$content</p><br>";
                echo "</div>";
                echo "</div>";
                echo"<br><br><br>";


            }

        }

        mysqli_free_result($results2);
        mysqli_close($connection);

        ?>


    </div>
    <!-- This is the side column on the right -->
    <div id="right_column">
        <div id="search_and_post">
            <form action="searchResults.php" method="post">
                <input class="textfields" type="text" name="search" placeholder="Search...">
            </form>
            <form action="makepost.php">
                <input type="submit" class="textfields" value="Make New Post"/>
            </form>
        </div>
        <div id="trending_posts">
            <h4>Popular Posts</h4>
            <hr>
            <?php

            $host = "localhost";
            $database = "finalproject360";
            $user = "root";
            $password = "";

            $connection = mysqli_connect($host, $user, $password, $database);

            $error = mysqli_connect_error();
            if ($error != null) {
                $output = "<p>Unable to connect to database!</p>";
                exit($output);
            } else {

                $sql2 = "SELECT * FROM blogpost1  UNION SELECT * FROM blogpost2 UNION SELECT * FROM blogpost3 ORDER BY vote DESC limit 3";

                $results2 = mysqli_query($connection, $sql2);


                while ($row2 = mysqli_fetch_assoc($results2)) {

                    $popular = $row2['title'];

                    echo "<a href='#'>$popular</a><br><br>";


                }

            }

            mysqli_free_result($results2);
            mysqli_close($connection);

            ?>
            <h4>Latest Posts</h4>
            <hr>

            <?php

            $host = "localhost";
            $database = "finalproject360";
            $user = "root";
            $password = "";

            $connection = mysqli_connect($host, $user, $password, $database);

            $error = mysqli_connect_error();
            if ($error != null) {
                $output = "<p>Unable to connect to database!</p>";
                exit($output);
            } else {

                $sql2 = "SELECT * FROM blogpost1 UNION SELECT * FROM blogpost2 UNION SELECT * FROM blogpost3 ORDER BY date DESC LIMIT 3";

                $results2 = mysqli_query($connection, $sql2);


                while ($row2 = mysqli_fetch_assoc($results2)) {

                    $latest = $row2['title'];


                    echo "<a href='#'>$latest</a><br><br>";


                }

            }

            mysqli_free_result($results2);
            mysqli_close($connection);

            ?>

        </div>
    </div>
    <footer>
        <a href="#">Home</a> |
        <a href="#">Browse</a> |
        <a href="#">Search</a> |
        <a href="#">About Us</a> |
        <a href="#">Contact Us</a>
        <p><i>Copyright 2017 David Smekal</i></p>
    </footer>
</body>

</html>

