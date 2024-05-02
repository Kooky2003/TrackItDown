<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Track It Down</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="box">
      <img src="logo.png" alt="logo">
    </div>

    <form action=" " method="post">
      <div class="info">
        <div class="username">

          <p>Username:</p>
        </div>
        <div class="box1">
          <input id="username" type="username" name="username" required>
        </div>

        <div class="password">
          <p>Password:</p>
        </div>

        <div class="box2">
          <input id="password" type="password" name="password" required>
        </div>
        <div class="retypepassword">

          <p>Retype Password:</p>
        </div>

        <div class="box3">
          <input id="password" type="password" name="retypepassword" required>
        </div>

        <div class="txt">
          <p>Already Have an Account?
            <a href="login.php">LogIn.</a>
          </p>
        </div>

        <button name="signup">SignUp</button>



    </form>
  </div>
  </div>
  </div>
</body>

<?php
require('connection.php');

if (isset($_POST['signup'])) {
  // $username = $REQUEST['username'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $retypepassword = $_POST['retypepassword'];

  if ($password !== $retypepassword) {
    echo '<script>alert("Password and Retyped password doesnot match");</script>';

    // header("Location:./signup.php");

  } else {
    $verify_query = "SELECT  *FROM users WHERE username ='$username'";

    $res = mysqli_query($con, $verify_query);

      if ($res->num_rows == 0) {

        $insert_query = "INSERT INTO users VALUES ('$username','$password')";

        $create_query = "CREATE TABLE $username (
          taskname VARCHAR(10) PRIMARY KEY,
          taskdeadline DATE,
          timedeadline TIME,
          username VARCHAR(50),
          FOREIGN KEY (username) REFERENCES users(username)
      )";
              
        $result= mysqli_query($con, $insert_query);

        mysqli_query($con,$create_query);


          echo '<script>alert("User is added");</script>';
          header("Location:./login.php");
        }
        // else 
        // {
        //   //alert box required
        //   echo '<script>
        //   alert("Query Error");
        //   </script>';

        //   // echo("bruhhh");
        //   // echo("Query Error");
        // }
      // }
      else {
        echo '<script>alert("User already has an account");
        window.location.href="login.php";
        </script>';
        //alert box required

        // <script language='javascript'>
        // alert ('User already has an account');
        // </script>
        // <?php
      }
    }
  }

  $con->close();

 ?>