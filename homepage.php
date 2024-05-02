<?php

$encodedUsername = isset($_GET['username']) ? $_GET['username'] : '';
$decodedUsername = urldecode($encodedUsername);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="homepage.css">

</head>

<body>

    <div class="section">
        <div class="logo">
            <img src="logo.png" alt="logo" height= 40px>
            
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


    </div>

    <!-- todolist -->
    <div class="main">

        <div class="container">
            <div class="todolist">
                <button class="btn" id="btn" onclick="openpopup()">Add Task</button><br>
    
                <?php
                require 'connection.php';
                echo '<style>.strikethrough {text-decoration: line-through;} </style>';
                echo ('<script>
                    function taskdone(element) {
                        element.classList.toggle("strikethrough");
                    }
                    </script>
                    ');
    
                $query = "SELECT  taskname FROM $decodedUsername";
    
                $task_query = mysqli_query($con, $query);



                if($task_query->num_rows != 0)
                {
                    while ($row = mysqli_fetch_assoc($task_query)) {
                        foreach ($row as $columnName => $columnValue) {
                            echo ('<div class="container">
                            <div class="taskshow" onclick= "taskdone(this)"> </div>' . $columnValue . '
                            <div class="pomodoro" > <a href="pomodoro.php?username=' . urlencode($decodedUsername) . '&taskname=' . urlencode($columnValue) . '"><img src="right.png" onclick="datapass(\'' . $columnValue . '\')"></img></a>
                            </div>
                            </div>');
        
                        }
                    }

                }
                else
                {
                    echo("<script>alert('No data added');</script>");
                }
    
    
    
                ?>
    

    
    
                <!-- popup details   -->
                <ul id="listcontainer"> </ul>
            </div>
            <!-- graph -->
            <div class="graph">
                <h2 class="chart-heading">Productivity Meter</h2>
                <div class="programming-stats">
                    <div class="chart-container">
                        <canvas class="my-chart"></canvas>
                    </div>
    
                    <div class="details">
                        <ul></ul>
                    </div>
                </div>
    
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="script.js"></script>
            </div>
        </div>
    
        <div class="popup" id="popup">
            <img src="logo.png" alt="logo">
            <h2>Add a task</h2>
    
            <div class="data">
    
                <form method="POST">
    
                    <input type="text" name="taskname" id="taskname" onclick="addtask()" required>
    
                    <label for="taskdeadline">Task Deadline:(Date) </label>
    
                    <input type="date" name="taskdeadline" required>
    
    
                    <label for="taskdeadline">Task Deadline(Time): </label>
    
                    <input type="time" name="timedeadline" required>
    
                    <button name="done" id="done" onclick="closepopup()">Done</button>
                </form>
            </div>
    
        </div>
        </div>
    
        </div>
    </div>

    <script>

        let button = document.getElementById('btn');
        let popup = document.getElementById('popup');

        function openpopup() {

            const task = document.getElementById("inputbox");
            popup.classList.add("open-popup");

            if (task.value == '') {
                alert("Enter task");
            }
            else {
                let data = document.createElement("inputbox");
                data.innerHTML = task.value;
                listcontainer.appendchild(data);

                updateContent();
            }

            // data insert
            <?php
            require('connection.php');

            if (isset($_POST['done'])) {
                $taskname = $_POST['taskname'];
                $timedeadline = $_POST['timedeadline'];
                $taskdeadline = $_POST['taskdeadline'];

                $insert_query = "INSERT INTO $decodedUsername VALUES ('$taskname','$taskdeadline','$timedeadline','$decodedUsername')";

                $output = mysqli_query($con, $insert_query);
            }
            ?>
        }

        function datapass(taskName) {
            const username = encodeURIComponent('<?php echo $decodedUsername; ?>');
            const url = `pomodoro.php?username=${username}&taskname=${encodeURIComponent(taskName)}`;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Response from pomodoro.php:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        function closepopup() {
            popup.classList.remove("open-popup");
        }

        function logout() {
            window.location.href = "login.php";
            alert("Logged Out");
        }

    </script>

    <!-- //todolist css -->
    <style>
        body {
            background-color: #f0f0f0;
        }
        .main{
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: #dadebb;
            color: #3b6653;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 70%;            
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
        }

        .pomodoro img {
            height: 40px;
            width: auto;

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
  width: 200px;
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
.todolist{
    width: 50%;
  }

  .graph{
    width:50%;

  }
    </style>
    <link rel="stylesheet" href="style1.css" />
    </head>




</body>

</html>