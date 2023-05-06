<?php
session_start();

if (!isset($_SESSION['start_time'])) {
  // If start time is not set in session, set it to the current time
  $_SESSION['start_time'] = time();
}

// End time, 15 minutes (900 seconds) from start time
$end_time = $_SESSION['start_time'] + 900;

// Check if 15 minutes have elapsed
if (time() >= $end_time) {
  // Display message
  echo "15 minutes have elapsed.";

  // Unset start time variable to free up memory
  unset($_SESSION['start_time']);
}

// If end button is pressed before 15 minutes elapse, you can end the time by unsetting the start time session variable
if (isset($_POST['end_button'])) {
  // Unset start time variable to free up memory
  unset($_SESSION['start_time']);
}
?>
