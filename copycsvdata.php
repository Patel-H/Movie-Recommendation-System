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

// sql to create movie collection table where csv data will be copied to
$sql = "CREATE TABLE MovieData (
  ID int NOT NULL AUTO_INCREMENT,
  Movie_Title varchar(255),
  Avg_Rating float(2),
  PRIMARY KEY (ID)
);";

if ($conn->query($sql) === TRUE) {
    echo "MovieData table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create user ratings table, data will be retrieved from form.php and added with process.php
$sql2 = "CREATE TABLE UserRatings (
  ID int NOT NULL AUTO_INCREMENT,
  Movie varchar(255),
  User1_Rating float(2),
  User2_Rating float(2),
  User3_Rating float(2),
  User4_Rating float(2),
  PRIMARY KEY (ID)
);";

if ($conn->query($sql2) === TRUE) {
    echo "UserRatings table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//go through each line of csv and take data from particular columns
$row = 1;
$count = 0;
if (($handle = fopen("tmdb_5000_movies.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
      $count++;
    if ($count == 1) { continue; }
        $num = count($data);
       echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
             $col[$c] = $data[$c];
        }

        //$colDate = $col[11];
        $colTitle = $col[20];
        $colRating = $col[18];

        // SQL Query to insert data into DataBase
        $addData = "INSERT INTO MovieData(Movie_Title,Avg_Rating) VALUES('".$colTitle."','".$colRating."')";
      //check if data is added
        if ($conn->query($addData) === TRUE) {
            echo "Data added correctly";
        } else {
            echo "Error adding data: " . $conn->error;
        }
    }


    fclose($handle);
}

$conn->close();
?>
