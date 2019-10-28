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
$password = $_POST["Password"];


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

echo "Welcome, user $user <br>";

$conn = new mysqli("mysql.eecs.ku.edu", "hheeb", "aiH7vo7e", "hheeb");

/* check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($user === ""){
    echo "Error: the user field was left empty.";
} else {

    $query = "SELECT user_id FROM Users";
    $alreadyTaken = FALSE;

    if ($result = $conn->query($query)) {

    /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            if($user == $row["user_id"]){
              $alreadyTaken = TRUE;
            }
        }

    /* free result set */
        $result->free();
    }

    if ($alreadyTaken == FALSE) {

        $sql = "INSERT INTO Users (user_id) VALUES ('$user')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: this username is already take.";
    }



}



$conn->close();






?>
