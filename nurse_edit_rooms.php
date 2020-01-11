<?php
require_once "./connect.php";
require_once "./auth.php";

if($access_level == 1) {
  header("Location: ./login.php");
}

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

  <title>Rooms</title>
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
        <a class="nav-link" href="./doctors_patients.php">Dashboard</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./equipment.php">Equipment</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./available_medications.php">Medications</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./treat.php">Treatments</a>
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
        <a class="nav-link" href="./nurses_patients.php">Dashboard</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./nurse_edit_rooms.php">Rooms</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./available_medications.php">Medications</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="./add_patient.php">New Patient</a>
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
          <img class="img-avatar" src=<?php echo ($gender == 'M') ? "img/avatar_m.png" : "img/avatar_f.png";?> alt="Profile">
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
            <a class="nav-link" href="./doctors_patients.php">
              <i class="nav-icon fa fa-procedures"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./equipment.php">
              <i class="nav-icon fa fa-x-ray"></i> Equipment
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./available_medications.php">
              <i class="nav-icon fa fa-briefcase-medical"></i> Medications
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./treat.php">
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
            <a class="nav-link" href="./nurses_patients.php">
              <i class="nav-icon fa fa-procedures"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./nurse_edit_rooms.php">
              <i class="nav-icon fa fa-hospital"></i> Rooms
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./available_medications.php">
              <i class="nav-icon fa fa-briefcase-medical"></i> Medications
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add_patient.php">
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

      <div class="container-fluid">
            <div class="card">
      <div class="card-header">
      <i class="fa fa-align-justify"></i> Clinic's Nurses </div>
        <div class="card-body">
          <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
          <tr>
          <th>Room Number</th>
          <th>Room Patients</th>
          <th>Responsible Nurse - ID</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Telephone</th>
          <th>E-mail</th>
          <th>Address</th>
          <th>Work Hours Per Week</th>
          <th>Assign to New Nurse [ID]</th>
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

      $query = $db->prepare("SELECT r.number as rnumber, r.number_patients as rnumber_patients, e.id, e.name, e.surname, e.gender, e.telephone, e.email, e.addr_city, e.addr_street, e.addr_number, e.hours_per_week
        FROM rooms r
        LEFT JOIN responsibles y ON y.room_number = r.number
        LEFT JOIN employees e ON e.id = y.nurse_id
        WHERE r.clinic_id = :cID AND e.dept_clinic_id = :cID AND y.room_clinic_id = :cID;");
      $query->execute(['cID' => $clinic_id]);
      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $index=>$row) {
        echo "<tr>" .
        "<td>" . $row['rnumber'] . "</td>" .
        "<td>" . $row['rnumber_patients'] . "</td>" .
        "<td>" . $row['id'] . "</td>" .
        "<td>" . $row['name'] . " " . $row['surname'] . "</td>" .
        "<td>" . $row['gender'] . "</td>" .
        "<td>" . $row['telephone'] . "</td>" .
        "<td>" . $row['email'] . "</td>".
        "<td>" . $row['addr_city'] . " " . $row['addr_street'] . " " . $row['addr_number'] ."</td>" .
        "<td>" . $row['hours_per_week'] . "</td>".
        '<td><form name="form" action="responsibility_change.php" method="post"><div class="input-group" action="" method="POST"> <input class="form-control" id=nedit type="text" name="nedit" value=""> <span class="input-group-append">
        <button class="btn btn-primary" type=submit id = "oedit" name = "oedit" value = '. $row['rnumber'] .'>Edit</button>
        </span></form>
        </div></td>';

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
</body>
</html>
