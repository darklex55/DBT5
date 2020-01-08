<?php
  require_once "./connect.php";
  require_once "./auth.php";

  if($access_level == 2) {
    header("Location: ./login.php");
  }

?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

    <!-- Main styles for this application-->
    <link href="../css/style.css" rel="stylesheet" />
    <title>Treatment</title>
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="clearfix">
            <?php
              if (isset($_POST['patient_code']) && isset($_POST['diagnosis']) && isset($_POST['treatment'])) {
                try{
                  $dbconnect = new Connection();
                  $db = $dbconnect->openConnection();
                }catch(PDOException $error){
                  echo "<p id='connerror'>A connection error has occured.<br>Please contact us.<br>Error code: </p>" . $error->getMessage();
                  $dbconnect->closeConnection();
                }
                try{
                  $patient_code = $_POST['patient_code'];
                  $diagnosis = $_POST['diagnosis'];
                  $treatment = $_POST['treatment'];
                  $medicine = ($_POST['medicine'] == "") ? null : $_POST['medicine'];
                  $query = $db->prepare("INSERT INTO `treats` (`date`, `diagnosis`, `treatment`, `treating_doctor_id`, `treated_patient_code`, `treating_medication_name`, `treating_medication_clinic_id`) VALUES (:datti, :diagnosis, :treatment, :doctor, :patient, :med, :clinic);");
                  $query->execute(['datti' => date("Y-m-d H:i:s"),
                                  'diagnosis' => $diagnosis,
                                  'treatment' => $treatment,
                                  'doctor' => $user_id,
                                  'patient' => $patient_code,
                                  'med' => $medicine,
                                  'clinic' => $clinic_id]);
                  ?>
                    <h1 class="float-left display-3 mr-4">Success!</h1>
                    <h4 class="pt-3">The treatment has been logged</h4>
                    <p class="text-muted">Patient Code: <?php echo $patient_code; ?></p>
                    <button onclick="window.location.href='./treat.php'" type="button" class="btn btn-primary">Go Back</button>
                  <?php

                } catch (Exception $e) {
                    ?>
                      <h1 class="float-left display-3 mr-4">Error.</h1>
                      <h4 class="pt-3">Something went wrong.</h4>
                      <p class="text-muted"><?php echo $e->getMessage(); ?></p>
                      <button onclick="window.location.href='./treat.php'" type="button" class="btn btn-primary">Go Back</button>
                    <?php
                }

              } else {
                ?>
                  <h1 class="float-left display-3 mr-4">Error.</h1>
                  <h4 class="pt-3">Something went wrong.</h4>
                  <p class="text-muted">Make sure you selected all the required values.</p>
                  <button onclick="window.location.href='./treat.php'" type="button" class="btn btn-primary">Go Back</button>
                <?php
              }
            ?>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap and necessary plugins-->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
  </body>
</html>
