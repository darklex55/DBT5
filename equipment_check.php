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
    <link href="./css/style.css" rel="stylesheet" />
    <title>Equipment</title>
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="clearfix">
            <?php
              if(isset($_POST['rDuration']) && isset($_POST['rTime']) && isset($_POST['rDate']) && isset($_POST['rType'])){
                $begin = strtotime($_POST['rDate'] . $_POST['rTime']);
                $end = $begin + $_POST['rDuration']*60;
                $type = $_POST['rType'];

                $success = 0;
                $suggestion = "";

                try{
                  $dbconnect = new Connection();
                  $db = $dbconnect->openConnection();
                }catch(PDOException $error){
                  echo "<p id='connerror'>A connection error has occured.<br>Please contact us.<br>Error code: </p>" . $error->getMessage();
                  $dbconnect->closeConnection();
                }
                $q = $db->prepare("SELECT count(*) AS results_count FROM `equipment` WHERE `clinic_id`= :clinic AND `type`= :eqType AND `state` <> 0");
                $q->execute(['clinic' => $clinic_id,
                            'eqType' => $type]);
                $num_results = $q->fetch(PDO::FETCH_ASSOC);

                if($num_results['results_count'] == 0) {
                ?>
                  <h1 class="float-left display-3 mr-4">Unavailable.</h1>
                  <h4 class="pt-3">This equipment does not exist.</h4>
                  <p class="text-muted">The equipment may not exist in your clinic or may be undergoing maintenance.<br>Check the equipment list.</p>
                  <button onclick="window.location.href='./equipment.php'" type="button" class="btn btn-primary">Go Back</button>
                <?php
                } else {
                  $query = $db->prepare("SELECT `name` FROM `equipment` WHERE `clinic_id`= :clinic AND `type`= :eqType AND `state` <> 0");
                  $query->execute(['clinic' => $clinic_id,
                                  'eqType' => $type]);
                  $result = $query->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($result as $index=>$machine) {
                    $query2 = $db->prepare("SELECT `occupied_from`, `occupied_until` FROM `occupied` WHERE `equipment_clinic_id`= :clinic AND `equipment_name`= :eqname ORDER BY `occupied_from`, `occupied_until` ASC");
                    $query2->execute(['clinic' => $clinic_id,
                                    'eqname' => $machine['name']]);
                    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                    $oldend = 0;

                    $q3 = $db->prepare("SELECT count(*) AS results_count FROM `occupied` WHERE `equipment_clinic_id`= :clinic AND `equipment_name`= :eqname");
                    $q3->execute(['clinic' => $clinic_id,
                                'eqname' => $machine['name']]);
                    $num_results2 = $q3->fetch(PDO::FETCH_ASSOC);

                    if ($num_results2['results_count'] == 0) {
                      $query3 = $db->prepare("INSERT INTO `occupied` (`occupied_from`, `occupied_until`, `equipment_name`, `equipment_clinic_id`) VALUES (:ocfrom, :ocuntil, :oceqname, :occlinic);");
                      $query3->execute(['ocfrom' => date('Y-m-d H:i:s', $begin),
                                      'ocuntil' => date('Y-m-d H:i:s', $end),
                                      'oceqname' => $machine['name'],
                                      'occlinic' => $clinic_id]);
                      ?>
                        <h1 class="float-left display-3 mr-4">Success!</h1>
                        <h4 class="pt-3">The selected equipment is available.</h4>
                        <p class="text-muted">Equipment Name: <?php echo $machine['name']; ?></p>
                        <button onclick="window.location.href='./equipment.php'" type="button" class="btn btn-primary">Go Back</button>
                      <?php
                      $query4 = $db->prepare("INSERT INTO `equipment_requests` (`requested_from`, `requested_until`, `requesting_doctor_id`, `requested_equipment_name`, `requested_equipment_clinic_id`) VALUES (:rfrom, :runtil, :rdoctor, :reqname, :rclinic)");
                      $query4->execute(['rfrom' => date('Y-m-d H:i:s', $begin),
                                      'runtil' => date('Y-m-d H:i:s', $end),
                                      'rdoctor' => $user_id,
                                      'reqname' => $machine['name'],
                                      'rclinic' => $clinic_id]);
                      $success = 1;
                      break;
                    } else {
                      foreach ($result2 as $index => $range) {
                        $rangeBegin = strtotime($range['occupied_from']);
                        $rangeEnd = strtotime($range['occupied_until']);
                        echo "rangeBegin: " . $rangeBegin . "\n";
                        echo "rangeEnd: " . $rangeEnd . "\n";
                        if ($begin <= $rangeBegin && $end <= $rangeBegin && $begin >= $oldend) {
                          $query3 = $db->prepare("INSERT INTO `occupied` (`occupied_from`, `occupied_until`, `equipment_name`, `equipment_clinic_id`) VALUES (:ocfrom, :ocuntil, :oceqname, :occlinic);");
                          $query3->execute(['ocfrom' => date('Y-m-d H:i:s', $begin),
                                          'ocuntil' => date('Y-m-d H:i:s', $end),
                                          'oceqname' => $machine['name'],
                                          'occlinic' => $clinic_id]);
                          ?>
                            <h1 class="float-left display-3 mr-4">Success!</h1>
                            <h4 class="pt-3">The selected equipment is available.</h4>
                            <p class="text-muted">Equipment Name: <?php echo $machine['name']; ?></p>
                            <button onclick="window.location.href='./equipment.php'" type="button" class="btn btn-primary">Go Back</button>
                          <?php
                          $query4 = $db->prepare("INSERT INTO `equipment_requests` (`requested_from`, `requested_until`, `requesting_doctor_id`, `requested_equipment_name`, `requested_equipment_clinic_id`) VALUES (:rfrom, :runtil, :rdoctor, :reqname, :rclinic)");
                          $query4->execute(['rfrom' => date('Y-m-d H:i:s', $begin),
                                          'runtil' => date('Y-m-d H:i:s', $end),
                                          'rdoctor' => $user_id,
                                          'reqname' => $machine['name'],
                                          'rclinic' => $clinic_id]);
                          $success = 1;
                          break 2;
                        }
                        $oldend = $rangeEnd;
                      }

                    }

                  }

                }
                if ($success == 0) {
                  ?>
                    <h1 class="float-left display-3 mr-4">Failure.</h1>
                    <h4 class="pt-3">The equipment is unavailable for this time period.</h4>
                    <p class="text-muted">Please try specifying a different date, time or duration for your requested equipment.</p>
                    <button onclick="window.location.href='./equipment.php'" type="button" class="btn btn-primary">Go Back</button>
                  <?php
                }
              } else {
                header("Location: ./login.php");
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
