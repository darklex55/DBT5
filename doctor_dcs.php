<?php

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <!-- Cache -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />

  <!-- Icons-->
  <link href="./css/icons/simple-line-icons.css" rel="stylesheet"/>
  <link href="./css/icons/font-awesome.min.css" rel="stylesheet"/>

  <!-- Styles -->
  <link href="./css/style.css" rel="stylesheet"/>

  <title>Home</title>

  <style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
  </style>

</head>
<body id="routerOutlet" class="app header-fixed sidebar-fixed">
      <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="doctor.php" style="">
      <img class="navbar-brand-full" src="img/Red_Cross_icon.ico" width="100" height="30" alt="Clinic Group">
      <img class="navbar-brand-minimized" src="img/Red_Cross_icon.ico" width="120" height="80" alt="Clinic Group">
      </a>

      <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
      <a class="nav-link" href="#">My Patients</a>
      </li>
      <li class="nav-item px-3">
      <a class="nav-link" href="#">Equipment</a>
      </li>
      <li class="nav-item px-3">
      <a class="nav-link" href="#">Medications</a>
      </li>
      <li class="nav-item px-3">
      <a class="nav-link" href="#">Doctor List</a>
      </li>


      </ul>
      <ul class="nav navbar-nav ml-auto">

      <li class="nav-item dropdown d-md-down-none">

      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
      <div class="dropdown-header text-center">
      <strong>You have 5 pending tasks</strong>
      </div>
      <a class="dropdown-item" href="#">
      <div class="small mb-1">Upgrade NPM &amp; Bower
      <span class="float-right">
      <strong>0%</strong>
      </span>
      </div>
      <span class="progress progress-xs">
      <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
      </span>
      </a>
      <a class="dropdown-item" href="#">
      <div class="small mb-1">ReactJS Version
      <span class="float-right">
      <strong>25%</strong>
      </span>
      </div>
      <span class="progress progress-xs">
      <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </span>
      </a>
      <a class="dropdown-item" href="#">
      <div class="small mb-1">VueJS Version
      <span class="float-right">
      <strong>50%</strong>
      </span>
      </div>
      <span class="progress progress-xs">
      <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
      </span>
      </a>
      <a class="dropdown-item" href="#">
      <div class="small mb-1">Add new layouts
      <span class="float-right">
      <strong>75%</strong>
      </span>
      </div>
      <span class="progress progress-xs">
      <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
      </span>
      </a>
      <a class="dropdown-item" href="#">
      <div class="small mb-1">Angular 2 Cli Version
      <span class="float-right">
      <strong>100%</strong>
      </span>
      </div>
      <span class="progress progress-xs">
      <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
      </span>
      </a>
      <a class="dropdown-item text-center" href="#">
      <strong>View all tasks</strong>
      </a>
      </div>
      </li>
      <li class="nav-item dropdown d-md-down-none">

      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
      <div class="dropdown-header text-center">
      <strong>You have 4 messages</strong>
      </div>
      <a class="dropdown-item" href="#">
      <div class="message">
      <div class="py-3 mr-3 float-left">
      <div class="avatar">
      <img class="img-avatar" src="img/avatar_m.png" alt="user@mail.com">
      <span class="avatar-status badge-success"></span>
      </div>
      </div>
      <div>
      <small class="text-muted">John Doe</small>
      <small class="text-muted float-right mt-1">Just now</small>
      </div>
      <div class="text-truncate font-weight-bold">
      <span class="fa fa-exclamation text-danger"></span> Important message</div>
      <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
      </div>
      </a>
      <a class="dropdown-item" href="#">
      <div class="message">
      <div class="py-3 mr-3 float-left">
      <div class="avatar">
      <img class="img-avatar" src="img/avatar_m.png" alt="user@mail.com">
      <span class="avatar-status badge-warning"></span>
      </div>
      </div>
      <div>
      <small class="text-muted">John Doe</small>
      <small class="text-muted float-right mt-1">5 minutes ago</small>
      </div>
      <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
      <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
      </div>
      </a>
      <a class="dropdown-item" href="#">
      <div class="message">
      <div class="py-3 mr-3 float-left">
      <div class="avatar">
      <img class="img-avatar" src="img/avatar_m.png" alt="user@mail.com">
      <span class="avatar-status badge-danger"></span>
      </div>
      </div>
      <div>
      <small class="text-muted">John Doe</small>
      <small class="text-muted float-right mt-1">1:52 PM</small>
      </div>
      <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
      <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
      </div>
      </a>
      <a class="dropdown-item" href="#">
      <div class="message">
      <div class="py-3 mr-3 float-left">
      <div class="avatar">
      <img class="img-avatar" src="img/avatar_m.png" alt="user@mail.com">
      <span class="avatar-status badge-info"></span>
      </div>
      </div>
      <div>
      <small class="text-muted">John Doe</small>
      <small class="text-muted float-right mt-1">4:03 PM</small>
      </div>
      <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
      <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
      </div>
      </a>
      <a class="dropdown-item text-center" href="#">
      <strong>View all messages</strong>
      </a>
      </div>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <img class="img-avatar" src="img/avatar_m.png" alt="user@mail.com">
      </a>
      <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-header text-center">
      <strong>Account</strong>
      </div>
      <a class="dropdown-item" href="#">
      <i class="fa fa-bell-o"></i> Updates
      <span class="badge badge-info">42</span>
      </a>
      <a class="dropdown-item" href="#">
      <i class="fa fa-envelope-o"></i> Messages
      <span class="badge badge-success">42</span>
      </a>
      <a class="dropdown-item" href="#">
      <i class="fa fa-tasks"></i> Tasks
      <span class="badge badge-danger">42</span>
      </a>
      <a class="dropdown-item" href="#">
      <i class="fa fa-comments"></i> Comments
      <span class="badge badge-warning">42</span>
      </a>
      <div class="dropdown-header text-center">
      <strong>Settings</strong>
      </div>
      <a class="dropdown-item" href="#">
      <i class="fa fa-user"></i> Profile</a>
      <a class="dropdown-item" href="#">
      <i class="fa fa-wrench"></i> Settings</a>
      <a class="dropdown-item" href="#">
      <i class="fa fa-usd"></i> Payments
      <span class="badge badge-dark">42</span>
      </a>
      <a class="dropdown-item" href="#">
      <i class="fa fa-file"></i> Projects
      <span class="badge badge-primary">42</span>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">
      <i class="fa fa-shield"></i> Lock Account</a>
      <a class="dropdown-item" href="#">
      <i class="fa fa-lock"></i> Logout</a>
      </div>
      </li>
      </ul>
      <li class="nav navbar-nav d-md-down-none">
      <a class="nav-link" href="login.php">Logout</a>
      </li>

      <div class="container">
      <?php
$link = mysqli_connect("localhost", "root", "", "lab1920omada5_website");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt select query execution
$sql = "SELECT * FROM EMPLOYEES WHERE dept_clinic_id=1";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Personal Number</th>";
                echo "<th>Personal E-mail</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['surname'] . "</td>";
                echo "<td>" . $row['telephone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
</div class="container">
</header>
</body>
</html>
