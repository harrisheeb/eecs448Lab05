<?php



echo "<head>
<style>
table, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th {
  border: 1px solid red;
  border-collapse: collapse;
  background-color:rgb(200, 200, 200);
}
th, td {
  padding: 5px;
  text-align: left;
}
</style>
</head>";
$user = $_POST["User"];


echo "<h1> Table of posts from $user : </h1>";


$conn = new mysqli("mysql.eecs.ku.edu", "hheeb", "aiH7vo7e", "hheeb");

/* check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$query = "SELECT post_id, content, author_id FROM Posts";
echo "<table>";
echo "</tr><td><b>post_id</b></td><td><b>content</b></td><td><b>author_id</b></td></tr>";
if ($result = $conn->query($query)) {

/* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        if($row["author_id"] == "$user"){
            echo "</tr><td>" . $row["post_id"] . "</td><td>"  . $row["content"] . "</td><td>"  . $row["author_id"] . "</td></tr>";
        }
    }

    /* free result set */
    $result->free();
}

echo "</table>";


$conn->close();






?>
