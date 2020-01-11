<?php
require_once "./connect.php";
require_once "./auth.php";

if (isset($_POST['pgenderM'])){
  $pgender = "M";
} else {
  $pgender = "F";
}



if(isset($_POST['pcode']) && isset($_POST['preason']) && isset($_POST['pdoctor']) && isset($_POST['proom'])) {
  $db = $dbconnect->openConnection();
  $query = $db->prepare("INSERT INTO patients(patient_code,id,name,surname,gender,addr_city,addr_street,addr_number,birth_date,amka,afm,telephone,admission_reason,attended_by,admission_date,discharge_date,blood_type,patient_room,current_fee,patient_clinic_id) VALUES
  (:pc,:id,:fname,:lname,:gender,:city,:street,:num,:bd,:amka,:afm,:tel,:adm_rea,:doc,:aa,:dd,:blood,:room,:fee,:c_id)");
  $query->execute(['pc' => $_POST['pcode'],
                  'id' => $_POST['pID'],
                  'fname' => $_POST['pname'],
                  'lname' => $_POST['psurname'],
                  'gender' => $pgender,
                  'city' => $_POST['pcity'],
                  'street' => $_POST['pstreet'],
                  'num' => $_POST['pnumber'],
                  'bd' => $_POST['pbd'],
                  'amka' => $_POST['pAMKA'],
                  'afm' => $_POST['pAFM'],
                  'tel' => $_POST['pphone'],
                  'adm_rea' => $_POST['preason'],
                  'doc' => $_POST['pdoctor'],
                  'aa' => date('Y-m-d H:i:s'),
                  'dd' => NULL,
                  'blood' => $_POST['pblood'],
                  'room' => $_POST['proom'],
                  'fee' => 0,
                  'c_id' => $clinic_id]);

  $dbconnect->closeConnection();
}
  header("Location: add_patient.php");

?>
