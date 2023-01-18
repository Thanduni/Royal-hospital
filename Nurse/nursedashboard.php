
<?php $page = 'nurseDashboard';?>
<?php include '../Components/nurseSidebar.php';
include '../Components/nursetopbar.php';
require_once("../conf/config.php")
?>
<style>
    <?php include '../css/nurseStyle.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    
    <div class="main-container">
        <div class="cards">
            <div class="card">
                <div class="card-content">
                    <div class="number">
                      <?php
                      $dash_patient_query = "select * from `user` where user_role = 'Patient';";
                      $dash_patient_query_run = mysqli_query($con,$dash_patient_query);
                      if($total_patient = mysqli_num_rows($dash_patient_query_run)){
                        echo $total_patient ;
                      }
                      else{
                        echo 'No Data';
                      }
                      ?>
                    </div>
                    <div class="card-name">Total Patients</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-injured"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">
                      <?php
                      $dash_bed_query="Select * from `room` where room_availability='available';";
                      $dash_bed_query_run = mysqli_query($con,$dash_bed_query);
                      if($total_available_beds = mysqli_num_rows($dash_bed_query_run)){
                        echo $total_available_beds;
                      }
                      else{
                        echo 'No data';
                      }
                      ?>
                    </div>
                    <div class="card-name">Available Beds</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-bed"></i>
                </div>
            </div>
        </div>
        
        
        <!-- <div class="charts">
            <div class="chart">
                <h2>Patient Count</h2>
                <canvas id="myChart"></canvas>
                <script>
                    var xValues = ["jan","feb","march","apr","may","june","july","agu","sep","oct","nov","dec"];
                    var yValues = [70,30,80,90,50,90,100,110,120,140,150,130];
                    
                    new Chart("myChart", {
                      type: "line",
                      data: {
                        labels: xValues,
                        datasets: [{
                          fill: false,
                          lineTension: 0,
                          backgroundColor: "rgba(0,0,255,1.0)",
                          borderColor: "rgba(0,0,255,0.1)",
                          data: yValues
                        }]
                      },
                      options: {
                        legend: {display: false},
                        scales: {
                          yAxes: [{ticks: {min: 0, max:150}}],
                        }
                      }
                    });
                    </script>
            </div>
            
            <div class="chart">
                <h2>Patient Count Gender vise</h2>
                <canvas id="pie-chart"></canvas>
                <script>
                    var xValues = ["Male", "Female"];
                    var yValues = [55, 45];
                    var barColors = [
                      "#189AB4",
                      "#75E6DA"
                    ];
                    
                    new Chart("pie-chart", {
                      type: "pie",
                      data: {
                        labels: xValues,
                        datasets: [{
                          backgroundColor: barColors,
                          data: yValues
                        }]
                      },
                      options: {
                        title: {
                          display: true,
                        //   text: "Patient Count Gender"
                        }
                      }
                    });
                    </script>
            </div>
        </div> -->
        
    </div>
    
</body>
</html>

