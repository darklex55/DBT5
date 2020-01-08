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

      <div class="col-md-6">
    <div class="card">
    <div class="card-header">
    <strong>New Patient Form</strong></div>
    <div class="card-body">

    <form class="form-horizontal" action="insert_patient.php" method="post" enctype="multipart/form-data">
    <div class="form-group row">
    <div class="col-md-9">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pname">Name</label>
    <div class="col-md-9">
    <input class="form-control" id="pname" type="text" name="pname">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="psurname">Surname</label>
    <div class="col-md-9">
    <input class="form-control" id="psurname" type="text" name="psurname">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pID">ID</label>
    <div class="col-md-9">
    <input class="form-control" id="pID" type="text" name="pID">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pAMKA">SSN</label>
    <div class="col-md-9">
    <input class="form-control" id="pAMKA" type="text" name="pAMKA">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pAFM">Tax ID</label>
    <div class="col-md-9">
    <input class="form-control" id="pAFM" type="text" name="pAFM">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdate">Birth Date</label>
    <div class="col-md-9">
    <input class="form-control" id="pbd" type="date" name="pbd" placeholder="pdate">
    <span class="help-block">Please enter a valid date</span>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label">Gender</label>
    <div class="col-md-9 col-form-label">
    <div class="form-check form-check-inline mr-1">
    <input class="form-check-input" id="pgenderM" type="radio" value="M" name="pgenderM">
    <label class="form-check-label" for="pgenderM">Male</label>
    </div>
    <div class="form-check form-check-inline mr-1">
    <input class="form-check-input" id="pgenderF" type="radio" value="F" name="pgenderF">
    <label class="form-check-label" for="pgenderF">Female</label>
    </div>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pphone">Telephone</label>
    <div class="col-md-9">
    <input class="form-control" id="pphone" type="text" name="pphone">
    </div>
    </div>

    <div><div class="form-group row"></div>
    <center>
    <label class="col-md-3 col-form-label">Address</label>
    </center>
    <div><div class="form-group row"></div>

    <div class="row">
    <div class="form-group col-sm-4">
      <div class="form-group">
      <label for="pcity">City</label>
      <input class="form-control" id="pcity" type="text" name="pcity">
    </div>
    </div>
    <div class="form-group col-sm-4">
      <div class="form-group">
      <label for="pstreet">Street</label>
      <input class="form-control" id="pstreet" type="text" name="pstreet">
    </div>
    </div>
    <div class="col-sm-4">
    <div class="form-group">
    <label for="pnumber">Number</label>
    <input class="form-control" id="pnumber" type="text" name="pnumber">
    </div>
    </div>
    </div>
    <div><div class="form-group row"></div>
    <div><div class="form-group row"></div>

    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="padmdate">Admission Date</label>
    <div class="col-md-9">
    <input class="form-control" id="padmdate" type="date" name="padmdate" placeholder="date">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdisdate">Discharge Date</label>
    <div class="col-md-9">
    <input class="form-control" id="pdisdate" type="date" name="pdisdate" placeholder="date" value=NULL>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="preason">Admission Reason</label>
    <div class="col-md-9">
    <textarea class="form-control" id="preason" name="preason" rows="9"></textarea>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pblood">Blood Type</label>
    <div class="col-md-9">
    <select class="form-control" id="pblood" name="pblood">
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
    </select>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="proom">Patient Room</label>
    <div class="col-md-9">
    <input class="form-control" id="proom" type="text" name="proom">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdoctor">Attented By</label>
    <div class="col-md-9">
    <input class="form-control" id="pdoctor" type="text" name="pdoctor">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pfee">Current Fee</label>
    <div class="col-md-9">
    <input class="form-control" id="pfee" type="text" name="pfee">
    </div>
    </div>
    <div class="form-group row">
    <label class="col-md-3 col-form-label" for="pcode">Patient Code Number</label>
    <div class="col-md-9">
    <input class="form-control" id="pcode" type="text" name="pcode">
    </div>
    </div>
    </form>
    </div>
    <div class="card-footer">
    <button class="btn btn-sm btn-primary" type="submit">
    <i class="fa fa-dot-circle-o"></i>Submit</button>
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
