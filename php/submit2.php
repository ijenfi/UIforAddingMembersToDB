<?php

    $studentId = $_POST['studentId'];
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
    $sql = "INSERT INTO students (studentId, id, firstName, lastName) VALUES ('$studentId', '$id', '$firstName', '$lastName')";

    //print_r($_POST);
    if(mysqli_query($con,$sql)){
        echo "The new student has been added successfully to the database !!<br/>";
    }
    else{
        echo "Error: ".mysqli_error($con);
    }
    //Change table name each time new student added by respecting the order of the internID ascendingly
    $sql1 = "CREATE TABLE `{$studentId}` (
      studentId INT,
      id INT,
      firstName VARCHAR(12),
      lastName VARCHAR(12),
      signIn DATETIME(6),
      signOut DATETIME(6),
      totalHours DATETIME(6)
    ) AS SELECT *
        FROM students ORDER BY studentId DESC LIMIT 1";


        if(mysqli_query($con,$sql1)){
          echo "And the new member's table has been created successfully !!";
        } else {
          echo "Error creating table: " .mysqli_error($con);
}
?>
