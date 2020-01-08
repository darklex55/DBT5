<?php
require_once "./connect.php";
require_once "./auth.php";

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
</head>
<body class="app header-fixed sidebar-fixed">
  <header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="./index.php">
      <img class="navbar-brand-full" src="img/logo.svg" width="89" height="25" alt="Clinic Logo">
      <img class="navbar-brand-minimized" src="img/sygnet.svg" width="30" height="30" alt="Clinic Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
      <span class="navbar-toggler-icon"></span>
    </button>
  <?php if ($access_level == 1) {
    // Navbar for doctors
  ?>
    <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Equipment</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./available_medications.php">Medications</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Treatments</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./available_doctors.php">Doctors</a>
      </li>
    </ul>
  <?php } else if ($access_level == 2) {
    // Navbar for nurses
  ?>
    <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Rooms</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./available_medications.php">Medications</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">New Patient</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./available_doctors.php">Doctors</a>
      </li>
    </ul>
  <?php } else {
          // If for some reason another access level is found
            header("Location: ./logout.php");
        } ?>
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img class="img-avatar" src=<?php echo ($gender == 'm') ? "img/avatar_m.png" : "img/avatar_f.png";?> alt="Profile">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Account</strong>
          </div>
          <a class="dropdown-item disabled" href="#">
            <i class="fa fa-user"></i> Welcome <?php echo $name; ?>
          </a>
          <a class="dropdown-item" href="./logout.php">
            <i class="fa fa-lock"></i> Logout</a>
        </div>
      </li>
    </ul>
  </header>

  <div class="app-body">
    <div class="sidebar">
      <nav class="sidebar-nav">
        <ul class="nav">
        <?php if ($access_level == 1) {
          // Sidebar for doctors
        ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon fa fa-procedures"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon fa fa-x-ray"></i> Equipment
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./available_medications.php">
              <i class="nav-icon fa fa-briefcase-medical"></i> Medications
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon fa fa-stethoscope"></i> Treatments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./available_doctors.php">
              <i class="nav-icon fa fa-user-md"></i> Doctors
            </a>
          </li>
        <?php } else if ($access_level == 2) {
          // Sidebar for nurses
        ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon fa fa-procedures"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon fa fa-hospital"></i> Rooms
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./available_medications.php">
              <i class="nav-icon fa fa-briefcase-medical"></i> Medications
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon fa fa-ambulance"></i> New Patient
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./available_doctors.php">
              <i class="nav-icon fa fa-user-md"></i> Doctors
            </a>
          </li>
        <?php } else {
          // If for some reason another access level is found
                  header("Location: ./logout.php");
              } ?>
        </ul>
      </nav>
    </div>
    <br>

    <main class="main">
      <ol class="breadcrumb" style="padding: 0; border: none;">
      </ol>
      <div class="card">
        <div class="card-header">
        <i class="fa fa-align-justify"></i> My Patients </div>
        <div class="card-body">
          <table class="table table-responsive-sm table-striped">
          <thead>
          <tr>
          <th>Patient Code</th>
          <th>Name</th>
          <th>SSN</th>
          <th>Gender</th>
          <th>Blood Type</th>
          <th>Patient Room</th>
          <th>Admission Date</th>
          <th>Admission Reason</th>
          <th>Treat History</th>
          <th> </th>
          </tr>
          </thead>
          <tbody>

    <?php
      try{
        $dbconnect = new Connection();
        $db = $dbconnect->openConnection();
      }catch(PDOException $error){
        echo "<p id='connerror'>A connection error has occured.<br>Please contact us.<br>Error code: </p>" . $error->getMessage();
        $dbconnect->closeConnection();
      }

      $query = $db->prepare("SELECT p.patient_code, p.name as pname, p.surname as psurname, p.amka, p.gender, p.blood_type, p.patient_room, p.admission_date, p.admission_reason
        FROM patients p
        WHERE attended_by = :dID AND discharge_date IS NULL");
      $query->execute(['dID' => $user_id]);
      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $index=>$row) {
        echo "<tr>" .
        "<td>" . $row['patient_code'] . "</td>" .
        "<td>" . $row['pname'] . " " . $row['psurname'] . "</td>" .
        "<td>" . $row['amka'] . "</td>" .
        "<td>" . $row['gender'] . "</td>" .
        "<td>" . $row['blood_type'] . "</td>" .
        "<td>" . $row['patient_room'] . "</td>".
        "<td>" . $row['admission_date'] . "</td>".
        "<td>" . $row['admission_reason'] . "</td>";
        echo "<td></td>";
        echo '<td><form name="TreatButton" action="treat.php" method="POST"><button class="btn btn-block btn-success active" type="submit" id=treat name=treat value='. $row['patient_code'] .'>New Treat</button></form></td>';
        echo "</tr>";
      }

    ?>

          </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>

  <footer class="app-footer">
    <div>
      <a>Databases Team 5</a>
      <span>&copy; 2019-2020</span>
    </div>
    <div class="ml-auto">
      <span>Powered by</span>
      <a href="https://coreui.io">CoreUI</a>
    </div>
  </footer>

  <!-- Bootstrap and necessary plugins-->
  <script src="./js/dependencies/jquery.min.js"></script>
  <script src="./js/dependencies/bootstrap.min.js"></script>
  <script src="./js/dependencies/coreui.min.js"></script>

  <!-- Routing -->
  <script src="./js/templateCallbacks.js"></script>
  <script src="./js/dependencies/sparouter.min.js"></script>
  <script src="./js/routing.js"></script>

  <!-- <script src="./js/dependencies/popper.min.js"></script>
  <script src="./js/dependencies/pace.min.js"></script>
  <script src="./js/dependencies/perfect-scrollbar.min.js"></script>
  <script src="./js/dependencies/coreui-utilities.min.js"></script>
  <script src="./js/dependencies/Chart.min.js"></script>
  <script src="./js/dependencies/custom-tooltips.min.js"></script>
  <script src="./js/dependencies/main.js"></script> -->
</body>
</html>
