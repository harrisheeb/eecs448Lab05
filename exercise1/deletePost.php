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
$numPosts = 0;


echo "<h1> Posts Deleted.</h1>";
echo "<h3> Post ID's that were deleted:</h3>";


$conn = new mysqli("mysql.eecs.ku.edu", "hheeb", "aiH7vo7e", "hheeb");

/* check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$query = "SELECT post_id FROM Posts";
if ($result = $conn->query($query)) {

/* fetch associative array */
    while ($row = $result->fetch_assoc()) {
      $x = $row["post_id"];
      if(isset($_POST['post' . $x]) && $_POST['post' . $x] == 'Bike'){
        echo $x . "<br>";
        $query2 = "DELETE FROM Posts WHERE post_id='" . "$x'";
        $conn->query($query2);
      }
    }

    /* free result set */
    $result->free();
}


$conn->close();






?>
