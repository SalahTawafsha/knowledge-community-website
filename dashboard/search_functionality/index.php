<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Functionality</title>
</head>

<body>
    <center>
        <h1>Search functionality</h1>
        <p>Here, You can search for specific topics, keywords, or members.</p>
        <form method="post" action="?">
            <fieldset style="width: 0;">

                keyword to search:
                <input type="search" placeholder="Search" name="search_topic">
                <br><br>
                <input type="submit" value="Search">

            </fieldset>

        </form>
        <br>
        <br>
        <?php
        include_once "../db_connect.inc";

        // PHP code starts here
        if ($_SERVER["REQUEST_METHOD"] === "POST")
            $search_topic = $_POST['search_topic'];
        else
            $search_topic = "";

        $connection = connect();

        session_start();
        $query = "select * from article where title 
            like '%" . $search_topic . "%'
             OR keywords like '%" . $search_topic . "%' 
             OR user_email like '%" . $search_topic . "%'";


        $result = $connection->query($query);


        echo "<table border=\"1px\">
        <thead>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
        </thead>";

        while ($row = $result->fetch()) {
            echo "<tr>
                <td><a href=\"article_details.php?title=" . $row["title"] . "\">" . $row["title"] . "</a></td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["description"] . "</td>

                </tr>";
        }

        $query = "select * from files where title 
            like '%" . $search_topic . "%'
             OR keywords like '%" . $search_topic . "%' 
             OR user_email like '%" . $search_topic . "%'";


        $result = $connection->query($query);

        while ($row = $result->fetch()) {
            echo "<tr>
                <td><a href=\"file_details.php?title=" . $row["title"] . "\">" . $row["title"] . "</a></td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["description"] . "</td>

                </tr>";
        }

        echo "</table>";

        ?>


    </center>
</body>

</html>