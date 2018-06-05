<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "Movies";

// Create connection to db created in createdb.php
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//get form data
if($_POST['formSubmit'] == "Submit")

{
  $varName = $_POST['user'];
  $varMovie = $_POST['Movies'];
  $varRating = $_POST['rating'];
  $errorMessage = "";
}

//check if a row/value already exists
$exists = "SELECT ID FROM UserRatings WHERE Movie = '$varMovie'";
$result = $conn->query($exists);
$varMovie = str_replace("'","''", $varMovie);
$updatedMovieName = mysqli_real_escape_string($conn,$varMovie);

//echo $updatedMovieName;



//User1 SUBMISSION
if($_POST['user'] == "User1") {

  if($result->num_rows == 0) {

    $userData1 = "INSERT INTO UserRatings(Movie,User1_Rating) VALUES('".$varMovie."','".$varRating."')";

    if ($conn->query($userData1) === TRUE) {
        echo "Data added successfully";
      } else {
            echo "Error adding data: " . $conn->error;
          }
}
else {

        $update1 = "UPDATE `UserRatings`
        SET `User1_Rating` = $varRating
        WHERE Movie='$updatedMovieName'";

        if ($conn->query($update1) === TRUE) {
            echo "Row updated successfully";
           } else {
                echo "Error adding data: " . $conn->error;
            }


}
}


//User2 SUBMISSION
if($_POST['user'] == "User2") {

  if($result->num_rows == 0) {
$userData2 = "INSERT INTO UserRatings(Movie,User2_Rating) VALUES('".$varMovie."','".$varRating."')";

if ($conn->query($userData2) === TRUE) {
    echo "Data added successfully";
  } else {
      echo "Error adding data: " . $conn->error;
  }
}
  else {
    $update2 = "UPDATE `UserRatings`
    SET `User2_Rating` = $varRating
    WHERE Movie='$updatedMovieName'";

    if ($conn->query($update2) === TRUE) {
        echo "Row updated successfully";
       } else {
            echo "Error adding data: " . $conn->error;
        }

   }


}

//User3 SUBMISSION
if($_POST['user'] == "User3") {

  if($result->num_rows == 0) {
$userData3 = "INSERT INTO UserRatings(Movie,User3_Rating) VALUES('".$varMovie."','".$varRating."')";

if ($conn->query($userData3) === TRUE) {
    echo "Data added successfully";
  } else {
      echo "Error adding data: " . $conn->error;
  }
}
  else {
    $update3 = "UPDATE `UserRatings`
    SET `User3_Rating` = $varRating
    WHERE Movie='$updatedMovieName'";

    if ($conn->query($update3) === TRUE) {
        echo "Row updated successfully";
       } else {
            echo "Error adding data: " . $conn->error;
        }

   }


}


//User4 SUBMISSION
if($_POST['user'] == "User4") {

  if($result->num_rows == 0) {
$userData4 = "INSERT INTO UserRatings(Movie,User4_Rating) VALUES('".$varMovie."','".$varRating."')";

if ($conn->query($userData4) === TRUE) {
    echo "Data added successfully";
  } else {
      echo "Error adding data: " . $conn->error;
  }
}
  else {
    $update4 = "UPDATE `UserRatings`
    SET `User4_Rating` = $varRating
    WHERE Movie='$updatedMovieName'";

    if ($conn->query($update4) === TRUE) {
        echo "Row updated successfully";
       } else {
            echo "Error adding data: " . $conn->error;
        }

   }


}


?>

<html>
<head>
<title> Form Data </title>
</head>
<body>
<h3>Form submission successful</h3>
<p> Your name: <?php echo $varName; ?> </p>
<p> Movie: <?php echo $varMovie; ?> </p>
<p> Rating: <?php echo $varRating; ?> </p>
<a href="form.php">Back</a>
</body>
</html>
