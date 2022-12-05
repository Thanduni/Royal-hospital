<?php include 'include/sidebar.php';
include 'include/topbar.php';
$page=='dashboard'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <!-- <script src="./chart1.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <!-- <div class="top-bar">
        <div class="logo">

        </div>
    </div> -->
    <!-- <div class="sidebar">
        <div class="logo">
            <img src="./images/hospital-logo.PNG" alt="">
        </div>
        <div class="sidebar-name">
            <h1><span class="lab la-accosoft"></span>System</h1>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="">
                        <i class="fas fa-th-large"></i>
                        <div>Dashboard</div>
                    </a>
                </li>
                <li class="<?php if($page=='display'){echo 'active';}?>">
                    <a href="">
                        <i class="fas fa-user-injured"></i>
                        <div>Patient</div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-bed"></i>
                        <div>Beds</div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-file"></i>
                        <div>Report</div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-user"></i>
                        <div>Profile</div>
                    </a>
                </li>
            </ul>
        </div>
    </div> -->
    <div class="main-container">
        <div class="cards">
            <div class="card">
                <div class="card-content">
                    <div class="number">56</div>
                    <div class="card-name">Total Patients</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-injured"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">30</div>
                    <div class="card-name">Available Beds</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-bed"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number"></div>
                    <div class="card-name">Total Patients</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-injured"></i>
                </div>
            </div>
        </div>
        
        
        <div class="charts">
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
        </div>
        
    </div>
    
</body>
</html>