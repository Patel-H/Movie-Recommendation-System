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

//calculate average for user1 ratings where user2 has also rated
$mean1 =
"SELECT ROUND(AVG(User1_Rating),2)
FROM UserRatings
WHERE User1_Rating IS NOT NULL
AND User2_Rating IS NOT NULL;";
$resultAVG = $conn->query($mean1);

if($resultAVG->num_rows > 0)
{
  while($row = $resultAVG->fetch_assoc())
  {
    //echo "Average for User 1: " . $row['AVG(User1_Rating)'];
    $completeMean1 = $row['ROUND(AVG(User1_Rating),2)'];
    echo "<br>";
  }
}

//calculate average for user1 ratings where user4 has also rated
$mean1U4 =
"SELECT ROUND(AVG(User1_Rating),2)
FROM UserRatings
WHERE User1_Rating IS NOT NULL
AND User4_Rating IS NOT NULL;";
$resultAVGU4 = $conn->query($mean1U4);

if($resultAVGU4->num_rows > 0)
{
  while($row = $resultAVGU4->fetch_assoc())
  {
    //echo "Average for User 1: " . $row['AVG(User1_Rating)'];
    $completeMean1U4 = $row['ROUND(AVG(User1_Rating),2)'];
    echo "<br>";
  }
}


//calculate average for user2 ratings where user1 has also rated
$mean2 =
"SELECT ROUND(AVG(User2_Rating),2)
FROM UserRatings
WHERE User2_Rating IS NOT NULL
AND User1_Rating IS NOT NULL;";
$resultAVG2 = $conn->query($mean2);

if($resultAVG2->num_rows > 0)
{
  while($row = $resultAVG2->fetch_assoc())
  {
    //echo "Average for User 2: " . $row['ROUND(AVG(User2_Rating),1)'];
    $completeMean2 = $row['ROUND(AVG(User2_Rating),2)'];
    echo "<br>";
  }
}

//calculate average for user3 ratings where user1 has also rated
$mean3 =
"SELECT ROUND(AVG(User3_Rating),2)
FROM UserRatings
WHERE User3_Rating IS NOT NULL
AND User1_Rating IS NOT NULL;";
$resultAVG3 = $conn->query($mean3);

if($resultAVG3->num_rows > 0)
{
  while($row = $resultAVG3->fetch_assoc())
  {
    //echo "Average for User 3: " . $row['ROUND(AVG(User3_Rating),1)'];
    $completeMean3 = $row['ROUND(AVG(User3_Rating),2)'];
    echo "<br>";
  }
}

//calculate average for user4 ratings where user1 has also rated
$mean4 =
"SELECT ROUND(AVG(User4_Rating),2)
FROM UserRatings
WHERE User4_Rating IS NOT NULL
AND User1_Rating IS NOT NULL;";
$resultAVG4 = $conn->query($mean4);

if($resultAVG4->num_rows > 0)
{
  while($row = $resultAVG4->fetch_assoc())
  {
    //echo "Average for User 4: " . $row['ROUND(AVG(User4_Rating),1)'];
    $completeMean4 = $row['ROUND(AVG(User4_Rating),2)'];
    echo "<br>";
  }
}



echo "Average for User 1: " . $completeMean1; echo "<br>";
echo "Average for User 2: " . $completeMean2; echo "<br>";
echo "Average for User 3: " . $completeMean3; echo "<br>";
echo "Average for User 4: " . $completeMean4; echo "<br>";
echo "<br>";

$rankArrayU1 = Array();
$rankArrayU2 = Array();
$rankArrayU3 = Array();
$rankArrayU4 = Array();

$allRatings = "SELECT Movie, User1_Rating, User2_Rating, User3_Rating, User4_Rating FROM UserRatings";
$result = $conn->query($allRatings);

if($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    echo "Rating for User 1 for Movie: " . $row["Movie"] . " is: " . $row["User1_Rating"];
    echo "<br>";
    array_push($rankArrayU1, $row["User1_Rating"]);
    echo "Rating for User 2 for Movie: " . $row["Movie"] . " is: " . $row["User2_Rating"];
    echo "<br>";
    array_push($rankArrayU2, $row["User2_Rating"]);
    echo "Rating for User 3 for Movie: " . $row["Movie"] . " is: " . $row["User3_Rating"];
    echo "<br>";
    array_push($rankArrayU3, $row["User3_Rating"]);
    echo "Rating for User 4 for Movie: " . $row["Movie"] . " is: " . $row["User4_Rating"];
    echo "<br>";
    array_push($rankArrayU4, $row["User4_Rating"]);
  }
}


//user1 ratings minus mean/average for U4
$sqlU4 = "SELECT Movie, User1_Rating FROM UserRatings
        WHERE User4_Rating IS NOT NULL;
        ";
$resultU4=mysqli_query($conn, $sqlU4);
$storeArray1U4 = Array();
while($row = mysqli_fetch_array($resultU4, MYSQLI_NUM))
{
//echo $row[1]; //this prints out each value of the array
  $storeArray1U4[] = $row[1];
}
echo "<br>";

$filteredArray1U4 = array_filter($storeArray1U4);
echo "<br>";
print_r(array_values($filteredArray1U4));

foreach($filteredArray1U4 as &$rating)
{
  $rating = $rating - $completeMean1U4;
}

echo "<br>";
echo "Subtracted the Means for User1: ";
print_r(array_values($filteredArray1U4));


//user1 ratings minus mean/average for U2 & U3
$sql = "SELECT Movie, User1_Rating FROM UserRatings
        WHERE User2_Rating IS NOT NULL;
        ";
$result2=mysqli_query($conn, $sql);
$storeArray1 = Array();
while($row = mysqli_fetch_array($result2, MYSQLI_NUM))
{
//echo $row[1]; //this prints out each value of the array
  $storeArray1[] = $row[1];
}
echo "<br>";

$filteredArray1 = array_filter($storeArray1);
echo "<br>";
print_r(array_values($filteredArray1));

foreach($filteredArray1 as &$rating)
{
  $rating = $rating - $completeMean1;
}

echo "<br>";
echo "Subtracted the Means for User1: ";
print_r(array_values($filteredArray1));

//user2 ratings minus mean/average
$sql2 = "SELECT Movie, User2_Rating FROM UserRatings
        WHERE User1_Rating IS NOT NULL
        ";

$result3=mysqli_query($conn, $sql2);
$storeArray2 = Array();
while($row = mysqli_fetch_array($result3, MYSQLI_NUM))
{
  //echo $row[1]; //this prints out each value of the array
  $storeArray2[] = $row[1];
}
echo "<br>";

$filteredArray2 = array_filter($storeArray2);
echo "<br>";
print_r(array_values($filteredArray2));

foreach($filteredArray2 as &$rating2)
{
  $rating2 = $rating2 - $completeMean2;
}

echo "<br>";
echo "Subtracted the Means for User2: ";
print_r(array_values($filteredArray2));
echo "<br>";


//user3 ratings minus mean/average
$sql3 = "SELECT Movie, User3_Rating FROM UserRatings
        WHERE User1_Rating IS NOT NULL
        ";

$result4=mysqli_query($conn, $sql3);
$storeArray3 = Array();
while($row = mysqli_fetch_array($result4, MYSQLI_NUM))
{
  //echo $row[1]; //this prints out each value of the array
  $storeArray3[] = $row[1];
}


$filteredArray3 = array_filter($storeArray3);
echo "<br>";
print_r(array_values($filteredArray3));

foreach($filteredArray3 as &$rating3)
{
  $rating3 = $rating3 - $completeMean3;
}

echo "<br>";
echo "Subtracted the Means for User3: ";
print_r(array_values($filteredArray3));
echo "<br>";

//user4 ratings minus mean/average
$sql4 = "SELECT Movie, User4_Rating FROM UserRatings
        WHERE User1_Rating IS NOT NULL
        ";

$result5=mysqli_query($conn, $sql4);
$storeArray4 = Array();
while($row = mysqli_fetch_array($result5, MYSQLI_NUM))
{
  //echo $row[1]; //this prints out each value of the array
  $storeArray4[] = $row[1];
}


$filteredArray4 = array_filter($storeArray4);
echo "<br>";
print_r(array_values($filteredArray4));

foreach($filteredArray4 as &$rating4)
{
  $rating4 = $rating4 - $completeMean4;
}

echo "<br>";
echo "Subtracted the Means for User4: ";
print_r(array_values($filteredArray4));
echo "<br>";

print_r(array_values($filteredArray1U4));
echo "<br>";
echo "Subtracted the Means for User4 considering User1 Correct Array: ";
print_r(array_values($filteredArray1U4));
echo "<br>";




$numerator2 = 0;
$numerator3 = 0;
$numerator4 = 0;

//calculate numerator of sim formula

echo "<------------------------------------------------------------------------->-"; echo "<br>";

$keysOne = array_keys($filteredArray1);
$keysTwo = array_keys($filteredArray2);
$keysThree = array_keys($filteredArray3);
$keysFour = array_keys($filteredArray4);

//////STUCK HERE//////////
//For User2
$min2 = min(count($filteredArray1), count($filteredArray2));

for($i = 0; $i < $min2; $i++) {
    //echo "r1: " . $filteredArray1[$keysOne[$i]] . "<br>";
    //echo "r2: " . $filteredArray2[$keysTwo[$i]] . "<br><br>";
    $numerator2 = $numerator2 + ($filteredArray1[$keysOne[$i]]*$filteredArray2[$keysTwo[$i]]);
}

//For User3
$min3 = min(count($filteredArray1), count($filteredArray3));

for($i = 0; $i < $min3; $i++) {
    //echo "r1: " . $filteredArray1[$keysOne[$i]] . "<br>";
    //echo "r2: " . $filteredArray2[$keysTwo[$i]] . "<br><br>";
    $numerator3 = $numerator3 + ($filteredArray1[$keysOne[$i]]*$filteredArray3[$keysThree[$i]]);
}

//For User4
$min4 = min(count($filteredArray1U4), count($filteredArray4));

for($i = 0; $i < $min4; $i++) {
    //echo "r1: " . $filteredArray1[$keysOne[$i]] . "<br>";
    //echo "r2: " . $filteredArray2[$keysTwo[$i]] . "<br><br>";
    $numerator4 = $numerator4 + ($filteredArray1U4[$keysOne[$i]]*$filteredArray4[$keysFour[$i]]);
}


echo "<br>"; echo "The numerator for User2 is: " . $numerator2;
echo "<br>"; echo "The numerator for User3 is: " . $numerator3;
echo "<br>"; echo "The numerator for User4 is: " . round($numerator4,2);


//calculate denominator of sim formula
//duplicated of filteredArray1U4 to alter for formular for user1 values
$user1U4Values = $filteredArray1U4;

foreach($user1U4Values as &$value1)
{
  $value1 = $value1*$value1;
}
echo "<br>";
echo "<br>";
echo "Squared values for user1 array considering user4: ";
print_r(array_values($user1U4Values));

//duplicated of filteredArray1 to alter for formular for user1 values
$user1Values = $filteredArray1;

foreach($user1Values as &$value1)
{
  $value1 = $value1*$value1;
}
echo "<br>";
echo "<br>";
echo "Squared values for user1 array: ";
print_r(array_values($user1Values));


//duplicated of filteredArray2 to alter for formular for user2 values
$user2Values = $filteredArray2;

foreach($user2Values as &$value2)
{
  $value2 = $value2*$value2;
}

echo "<br>";
echo "Squared values for user2 array: ";
print_r(array_values($user2Values));

//duplicated of filteredArray3 to alter for formular for user3 values
$user3Values = $filteredArray3;

foreach($user3Values as &$value3)
{
  $value3 = $value3*$value3;
}

echo "<br>";
echo "Squared values for user3 array: ";
print_r(array_values($user3Values));

//duplicated of filteredArray4 to alter for formular for user4 values
$user4Values = $filteredArray4;

foreach($user4Values as &$value4)
{
  $value4 = $value4*$value4;
}

echo "<br>";
echo "Squared values for user4 array: ";
print_r(array_values($user4Values));


//sum the values for each array
$sum1 = array_sum($user1Values);
$sum2 = array_sum($user2Values);
$sum3 = array_sum($user3Values);
$sum4 = array_sum($user4Values);
$sum1U4 = array_sum($user1U4Values);

echo "<br>";
echo "Sum of squared values in user1 array: ";
echo $sum1;
echo "<br>";
echo "Sum of squared values in user2 array: ";
echo $sum2;
echo "<br>";
echo "Sum of squared values in user3 array: ";
echo $sum3;
echo "<br>";
echo "Sum of squared values in user4 array: ";
echo $sum4;
echo "<br>";
echo "Sum of squared values in user4 array considering user1: ";
echo $sum1U4;


//Calculating the denominator for User2
$denominator2 = ROUND(sqrt($sum1*$sum2),3);
echo "<br>";
echo "<br>"; echo "The denominator is: " . $denominator2;

$simScore2 = ROUND($numerator2/$denominator2, 3);
echo "<br>";
echo "<br>"; echo "The simularity score between user1 and user2 is: " . $simScore2;


//Calculating the denominator for User3
$denominator3 = ROUND(sqrt($sum1*$sum3),3);
echo "<br>";
echo "<br>"; echo "The denominator is: " . $denominator3;

$simScore3 = ROUND($numerator3/$denominator3, 3);
echo "<br>";
echo "<br>"; echo "The simularity score between user1 and user3 is: " . $simScore3;

//Calculating the denominator for User4
$denominator4 = ROUND(sqrt($sum1U4*$sum4),3);
echo "<br>";
echo "<br>"; echo "The denominator is: " . $denominator4;

$simScore4 = ROUND($numerator4/$denominator4, 3);
echo "<br>";
echo "<br>"; echo "The simularity score between user1 and user4 is: " . $simScore4;


echo "<br><br><br>";
//*********************************************************************
/*
//Getting Array for User1 Where rating is NULL
$noRankU1 = "SELECT User2_Rating, User3_Rating, User4_Rating FROM UserRatings
        WHERE User1_Rating IS NULL
        ";
$arrayForU1 = Array();

$temp=mysqli_query($conn, $noRankU1);
while($row = mysqli_fetch_array($temp, MYSQLI_NUM))
{
  echo "trial : " . $row[1]; //this prints out each value of the array
  $arrayForU1[] = $row[1];
}

echo "<br>";
print_r(array_values($arrayForU1));
*/
///////////////////////////////////////////
$arrayForID = Array();
echo "<br>";
$idk =
"SELECT ID FROM UserRatings
        WHERE User1_Rating IS NULL;";
$temp2 = $conn->query($idk);

if($temp2->num_rows > 0)
{
  while($row = $temp2->fetch_assoc())
  {
    echo "ID for User 1: " . $row['ID'];
    array_push($arrayForID, $row['ID']);
    //$id = $row[1];
    echo "<br>";
  }
}

echo "<br>";
print_r(array_values($arrayForID)); echo "<br>";

$simScores = Array();
array_push($simScores, $simScore2, $simScore3, $simScore4);

echo "array for User2 Rate: "; print_r(array_values($rankArrayU2)); echo "<br>";
echo "array for User3 Rate: "; print_r(array_values($rankArrayU3)); echo "<br>";
echo "array for User4 Rate: "; print_r(array_values($rankArrayU4)); echo "<br>";

echo "<br>Sim Score Array: "; print_r(array_values($simScores));
echo "<br>";

$some = Array();
$count = 0; $firstPart=0; $secondPart =0;
foreach($arrayForID as &$realID)
{
  foreach($simScores as &$score)
  {
    if($score > 0)
    {
        if($count == 0)
        {
        $firstPart = $firstPart + $score;
        $secondPart = $score*$rankArrayU3[$realID-1];
        $count = $count+1;
        }
        else {
          $firstPart = $firstPart + $score;
          $secondPart = $secondPart + ($score*$rankArrayU4[$realID-1]);

        }
    }
  }
  $r = 1/$firstPart*$secondPart;
  echo "<br>"; echo "FINAL: " . round($r, 2);
  $random = "SELECT Movie FROM UserRatings WHERE ID='$realID'";
  $new = $conn->query($random);
  echo "<br>";
  if($new->num_rows > 0)
  {
    while($row = $new->fetch_assoc())
    {
      if($r >= 3.5)
      {
      echo "I recommend the Movie: " . $row["Movie"];
      }
      else {
        echo "I dont recommend the movie";
      }
    }
  }

}



/*
$count =1;
foreach($arrayForU1 as &$u1)
{
  $r = 1/$simScore;
  echo "For the " . $count . " movie as null in U2 -> ";
  echo "User 2 would rate this: ";
  $count = $count+1;
  $r = $r * ($simScore * $u1);
  echo round($r,2); echo "<br>";
}
*/


?>
