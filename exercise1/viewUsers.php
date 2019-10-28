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


echo "<h1> List of all Users: </h1>";


$conn = new mysqli("mysql.eecs.ku.edu", "hheeb", "aiH7vo7e", "hheeb");

/* check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$query = "SELECT user_id FROM Users";
echo "<table>";
echo "</tr><td><b>user_id</b></td></tr>";
if ($result = $conn->query($query)) {

/* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        echo "</tr><td>" . $row["user_id"] . "</td></tr>";
    }

    /* free result set */
    $result->free();
}

echo "</table>";


$conn->close();






?>
