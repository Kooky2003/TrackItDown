
function sendTimeToDatabase(startTime,endTime)
    {

    difference =endTime-startTime;
    timetaken =Math.floor(difference/1000);
    
    console.log(timetaken);
    
        const usernamedata = "<?php echo (htmlspecialchars($decodedUsername, ENT_QUOTES, 'UTF-8')); ?>";
        const tasknamedata = "<?php echo (htmlspecialchars($decodedTaskname, ENT_QUOTES, 'UTF-8')); ?>";
    
        const pomodoroUrl = `pomodoro.php?username=${encodeURIComponent(usernamedata)}&taskname=${encodeURIComponent(tasknamedata)}`;
    

    fetch(pomodoroUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `username=${usernamedata}&taskname=${tasknamedata}&difference=${timetaken}`,
    })
    .then(res => res.json())
    .then(data => {

    })
    .catch(err => {
        console.log('Error:', err);
    });