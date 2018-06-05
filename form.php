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

$sql = "SELECT Movie_Title FROM MovieData
        WHERE Avg_Rating > 7.8
       ";

$result = mysqli_query($conn, $sql);
?>

<!-- actual form -->
<html>
<head>
<title> Title </title>
<link rel="stylesheet" href="movie.css">
</head>
<body>
<form action="process.php" method="post">
<h1>Movie Ratings</h1>
<label for='user'>Name: </label>
<select name='user'>
  <option value="User1">User1</option>
  <option value="User2">User2</option>
  <option value="User3">User3</option>
  <option value="User4">User4</option>
</select>
<select name='Movies'>
<?php
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['Movie_Title'] ."'>" . $row['Movie_Title'] ."</option>";
}

echo "</select>";
?>
<br>
<label for='rating'>Rating(1-5): </label>
  <input type="radio" name="rating" value="1">1
  <input type="radio" name="rating" value="2">2
  <input type="radio" name="rating" value="3">3
  <input type="radio" name="rating" value="4">4
  <input type="radio" name="rating" value="5">5

<input type="submit" name="formSubmit">
</form>
</body>
</html>
