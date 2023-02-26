<?php
require_once("../conf/config.php");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>doctor_work</title>
</head>
<body>
<form action="process-form.php" onsubmit="checkTotHrs()" method="post">
    <label for="start-time">Start Time:</label>
    <input type="time" id="start-time" name="start_time" step="1800" required>

    <label for="duration">Duration:</label>
    <input type="number" id="duration" name="duration" min="1" max="5" step="0.5" required> hours

    <div id="time-durations"></div>

    <button type="button" onclick="addTimeDuration()">Add Time Duration</button>
    <br><br>

    <button type="submit">Submit</button>
</form>
<script src="../js/doctorWork.js"></script>
</body>
</html>
