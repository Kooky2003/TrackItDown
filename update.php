<?php

$encodedUsername = isset($_GET['username']) ? $_GET['username'] : '';
$decodedUsername = urldecode($encodedUsername);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update</title>
</head>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

:root {
  --color-primary: #9bae8d;
  --color-highlight: rgb(243, 243, 243);
  --color-buttonbg: #dadebb;
  --color-text: #3b6653;
}

* {
  margin: 0px;
  padding: 0px;
  font-family: Poppins;
}
p {
  font-weight: 200;
}
h1 {
  font-weight: 700;
}
.container {
  display: flex;
  justify-content: space-evenly;
  height: 100vh;
  width: 100vw;
}



.section {
    display: flex;
    justify-content: center;
    margin: 0px;
    height: 60px;
    width: 100%;
    background-color: var(--color-buttonbg);
    color: white;
    overflow: none;
    align-items: center;
    gap: 50px;
    }

.container,.updateContainer p{
  font-size: 0.8rem;
}

    .section a {
    display: block;
    background-color: var(--color-buttonbg);
    color: var(--color-text);
    
    padding: 16px 44px 16px 44px;
    font-size: large;
    text-decoration: none;
    }
    
    .section a:active {
    background-color: var(--color-buttonbg);
    color: var(--color-text);
    }
    
    .section a:hover:not(.active) {
    background-color: var(--color-buttonbg);
    color: #3b6653;
    border-radius: 4px;
    }
    
    .links {
    display: flex;
    }
    
    .logo {
    width: 300px;
    height: 50px;
    display: flex;
    align-items: right;
    }
    
    .logout {
    display: flex;
    width: 25px;
    height: 25px;
    }
    
    .logout button {
    display: flex;
    width: 50px;
    height: 50px;
    border: none;
    border-radius: 10px;
    }
    

.box {
  margin-top: 24px;
  margin-bottom: 24px;
  text-align: center;
}


input {
  height: 32px;
  width: 368px;
  padding: 2px 4px 2px 4px;
  border-radius: 8px;
  margin-bottom: 16px;
  border: 2px solid var(--color-text);
}

  button {
  border-radius: 14px;
  padding: 8px 60px 8px 60px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.CTA {
  background-color: white;
  color: black;
  border: 2px solid var(--color-text);
}

.CTA:hover {
  background-color: var(--color-text);
  color: white;
}


.update {
  display: flex;
  justify-content: center;
}

.updateContainer {
  background-color: var(--color-highlight);
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 480px;
  height: 400px;
  padding: 34px 20px 34px 20px;
  margin: 6% auto;
  border-radius: 24px;
  position: absolute;
  top: 50%;
  left: 50%; 
  transform: translate(-50%, -50%);
}


</style>

<body>

  <div class="section">
    <div class="logo">
      <img src="logo.png" alt="logo">
    </div>


    <div class="links">
            <a href="homepage.php?username=<?php echo urlencode($decodedUsername); ?>" class="home">Home</a>
            <a href="pomodoro.php?username=<?php echo urlencode($decodedUsername); ?>" class="pomodoro">Pomodoro</a>
            <a href="calendar.php?username=<?php echo urlencode($decodedUsername); ?>" class="calendar">Calendar</a>
            <a href="update.php?username=<?php echo urlencode($decodedUsername); ?>" class="update">Update</a>

        </div>
        <div class="logout">
            <img src="logout.png" onclick="logout()">
        </div>
    </div>

    <div class="update">

      <div class="updateContainer">
      <div class="box">
        <img src="logo.png" alt="logo" height="38px" width="auto" >
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
              <p>Old Password:</p>
            </div>

            <div class="box2">
              <input id="password" type="password" name="oldpassword" required>
            </div>
            <div class="newpassword">

              <p>New Password:</p>
            </div>

            <div class="box3">
              <input id="password" type="password" name="newpassword" required>
            </div>

            <button name="update" class="CTA">Update</button>

        </form>

        <?php
        require('connection.php');

        if (isset($_POST['Update'])) {
          $username = $_POST['username'];
          $oldpassword = $_POST['oldpassword'];
          $newpassword = $_POST['newpassword'];

          if ($oldpassword == $newpassword) {
            echo "<script>alert('same password can't be used');</script>";
          } 
          else {
            $query = "SELECT *FROM users WHERE username = '$username'";
            
            $res = mysqli_query($con, $query);
            
            if ($res->num_rows == 0) {
              $updatequery = "UPDATE users SET password = '$newpassword' WHERE username ='$username'";
              
              echo '<script>alert("Password is updated");
              window.location.href="login.php";
              </script>';
            }
            else{
              echo "<script>alert('User not found');</script>";

            }
          }


        }

        ?>
        <script>
            function logout() {
            window.location.href = "login.php";
            alert("Logged Out");
        }
        </script>
</body>

</html>