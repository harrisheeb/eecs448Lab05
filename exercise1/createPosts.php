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

echo "<table>";

//access the global array called $_POST to get the values from the text fields

$user = $_POST["User"];
$postText = $_POST["PostText"];
$postId = 0;


//Inside myfirstprogram.php
/*
function sum($number, $userAnswer, $correctAnswer) {
    echo "Question $number<br>";
    echo "You answered: $userAnswer<br>";
    echo "Correct answer: $correctAnswer<br><br>";
    if($correctAnswer == $userAnswer){
	return 20;
    }
    return 0;
}
*/
echo "<h1> User Creation </h1>";

echo "Hello, $user <br>";

$conn = new mysqli("mysql.eecs.ku.edu", "hheeb", "aiH7vo7e", "hheeb");

/* check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($postText === ""){
    echo "Error: the post contained no text";
} else {

    $query = "SELECT user_id FROM Users";
    $query2 = "SELECT postId FROM Constants";

    $inDatabase = FALSE;

    if ($result = $conn->query($query)) {

    /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            if($user == $row["user_id"]){
              $inDatabase = TRUE;
            }
        }

    /* free result set */
        $result->free();
    }

    if ($result2 = $conn->query($query2)) {

    /* fetch associative array */
        while ($row2 = $result2->fetch_assoc()) {
            $postId = $row2["postId"];
        }
	$postIdInc = $postId + 1;
	$query3 = "INSERT INTO Constants (postId) VALUES ('$postIdInc')";
	$conn->query($query3);
    /* free result set */
        $result->free();
    }


    if ($inDatabase == TRUE) {

        $sql = "INSERT INTO Posts (author_id, content, post_id) VALUES ('$user', '$postText', '$postId')";

        if ($conn->query($sql) === TRUE) {
            echo "New post created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: this username has not been created.";
    }



}



$conn->close();






?>
