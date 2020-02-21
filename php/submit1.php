<?php
    $internId = $_POST['internId'];
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

  //Database connection

    $dbhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "thefirma";
    $con = new mysqli($dbhost, $username, $password, $dbname);

    if ($con -> connect_errno) {
      echo "Failed to connect to MySQL: " . $con -> connect_error;
      exit();
    }

    //Insert data to database
    $sql = "INSERT INTO interns (internId, id, firstName, lastName) VALUES ('$internId', '$id', '$firstName', '$lastName')";

    //print_r($_POST);
    if(mysqli_query($con,$sql)){
        echo "New intern has been added successfully to the database !!<br/>";
    }
    else{
        echo "Error: ".mysqli_error($con);
    }
      //Change table name each time new intern added by respecting the order of the internID ascendingly
      $sql1 = "CREATE TABLE intern2(
        internId INT,
        id INT,
        firstName VARCHAR(12),
        lastName VARCHAR(12),
        signIn DATETIME(6),
        signOut DATETIME(6),
        totalHours DATETIME(6)
      ) AS SELECT *
          FROM interns ORDER BY internId DESC LIMIT 1";
          //UPDATE intern1 SET signIn='2019-06-12 10:30:00', signOut='2019-06-12 15:00:00' WHERE internId=1;
          //SELECT TIMEDIFF(signOut, signIn) AS totalHours FROM intern1 WHERE internId=1
          //UPDATE intern1 SET totalHours = TIMEDIFF(signOut, signIn) working
          //SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(signOut) - TIME_TO_SEC(signIn))) AS total FROM intern1

  if(mysqli_query($con,$sql1)){
      echo "And the new member's table has been created successfully !!";
  } else {
      echo "Error creating table: " .mysqli_error($con);
  }

    //header("refresh:2; url=index.html");
?>
