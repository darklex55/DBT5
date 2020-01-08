<?php
require_once "./connect.php";
require_once "./auth.php";

if($access_level == 2) {
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

  <title>Equipment</title>
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
        <div id="routerOutlet" class="animated-fadeIn">

          <div class="card">
            <div class="card-header">Equipment</div>
              <div class="card-body">
                <table class="table table-responsive-sm">
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Name</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody id="equipment">
                    <?php
                      try{
                        $dbconnect = new Connection();
                        $db = $dbconnect->openConnection();
                      }catch(PDOException $error){
                        echo "<p id='connerror'>A connection error has occured.<br>Please contact us.<br>Error code: </p>" . $error->getMessage();
                        $dbconnect->closeConnection();
                      }

                      $query = $db->prepare("SELECT `name`, `type`, `state` FROM `equipment` WHERE `clinic_id`= :clinic");
              				$query->execute(['clinic' => $clinic_id]);
              				$result = $query->fetchAll(PDO::FETCH_ASSOC);

              				foreach ($result as $index=>$row) {
              					echo "<tr>" .
              					"<td>" . $row['type'] . "</td>" .
              					"<td>" . $row['name'] . "</td>";
                        echo ($row['state'] == 1) ? '<td><span class="badge badge-success">Available</span></td>' : '<td><span class="badge badge-danger">Maintenance</span></td>';
              					echo "</tr>";
              				}
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-0">Request Equipment</h4>
                <br>
                <form action="./equipment_check.php" method="POST" class="needs-validation" novalidate>
                  <div class="form-group">
                    <label for="selectType">Select Equipment Type</label>
                    <select class="custom-select" name="rType" id="selectType" required>
                      <option value="">No Selection</option>
                      <?php
                        $query = $db->prepare("SELECT DISTINCT `type` FROM `equipment` WHERE `clinic_id`= :clinic AND `state` = 1");
                        $query->execute(['clinic' => $clinic_id]);
                        $result2 = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result2 as $index=>$row2) {
                          echo '<option value="' . $row2['type'] . '">' . $row2['type'] . '</option>';
                        }
                      ?>
                    </select>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      You must select something!
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="selectDate">Select Date and Time</label>
                    <input class="form-control" type="date" name="rDate" id="selectDate" required min="<?php echo date('Y-m-d');?>">
                    <input class="form-control" type="time" value="12:00" name="rTime" required min="<?php echo date('H:i');?>">
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      The date needs to be in the future!
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="selectDuration">Select Duration (in minutes)</label>
                    <input class="form-control" type="number" value="30" name="rDuration" id="selectDuration" required min="0" max="500">
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      You need to select the exam duration. Please, make sure you don't occupy the resources for too much.
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Confirm Request</button>
                </form>
              </div>
            </div>

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

  <!-- Validation script -->
  <script src="./js/validation.js"></script>

</body>
</html>
