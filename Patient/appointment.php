<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="<? echo BASEURL .'/css/appointment.css';?>">
    <title>Appointment</title>
</head>
<body>
    <div class="wrapper">
        <div class="popup-box">
            <h2>Put Your Appointment</h2>
            <form action="" method="post">
                <label for="">Date</label><br><br>
                <input type="date" name="date" id="date"><br><br>
                <label for="">Department</label><br><br>
                <select name="department" id="department">
                    <option value="">Please A Select Department</option>
                    <option value="Anesthetics">Anesthetics</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Gastroentology">Gastroentology</option>
                </select><br><br>
                <label for="">Doctor</label><br><br>
                <select name="doctor" id="doctor">
                    <option value="">Select A Department First</option>
                </select><br><br>
                <label for="">Message</label><br><br>
                <textarea name="msg" id="msg" cols="30" rows="50" placeholder="Your Message To The Doctor"></textarea>
                <!-- <br><br><input type="submit" value="Submit" id="btn" name="btn" class="btn"> -->
                <button type="submit" name="submit" id="btn" value="submit" onclick="">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>