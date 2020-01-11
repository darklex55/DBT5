<?php
require_once "./connect.php";
require_once "./auth.php";

if (isset($_POST['pgenderM'])){
  $pgender = "M";
} else {
  $pgender = "F";
}

$pID = (isset($_POST['pID'])) ? $_POST['pID']) : null;
$pname = (isset($_POST['pname'])) ? $_POST['pname']) : null;
$psurname = (isset($_POST['psurname'])) ? $_POST['psurname']) : null;
$pcity = (isset($_POST['pcity'])) ? $_POST['pcity']) : null;
$pstreet = (isset($_POST['pstreet'])) ? $_POST['pstreet']) : null;
$pnumber = (isset($_POST['pnumber'])) ? $_POST['pnumber']) : null;
$pbd = (isset($_POST['pbd'])) ? $_POST['pbd']) : null;
$pAMKA = (isset($_POST['pAMKA'])) ? $_POST['pAMKA']) : null;
$pAFM = (isset($_POST['pAFM'])) ? $_POST['pAFM']) : null;
$ptel = (isset($_POST['pphone'])) ? $_POST['pphone']) : null;
$pblood = ($_POST['pblood'] != "") ? $_POST['pblood']) : null;

if(isset($_POST['pcode']) && isset($_POST['preason']) && isset($_POST['pdoctor']) && isset($_POST['proom'])) {
  $db = $dbconnect->openConnection();
  $query = $db->prepare("INSERT INTO patients(patient_code,id,name,surname,gender,addr_city,addr_street,addr_number,birth_date,amka,afm,telephone,admission_reason,attended_by,admission_date,discharge_date,blood_type,patient_room,current_fee,patient_clinic_id) VALUES
  (:pc,:id,:fname,:lname,:gender,:city,:street,:num,:bd,:amka,:afm,:tel,:adm_rea,:doc,:aa,:dd,:blood,:room,:fee,:c_id)");
  $query->execute(['pc' => $_POST['pcode'],
                  'id' => $pID,
                  'fname' => $pname,
                  'lname' => $psurname,
                  'gender' => $pgender,
                  'city' => $pcity,
                  'street' => $pstreet,
                  'num' => $pnumber,
                  'bd' => $pbd,
                  'amka' => $pAMKA,
                  'afm' => $pAFM,
                  'tel' => $ptel,
                  'adm_rea' => $_POST['preason'],
                  'doc' => $_POST['pdoctor'],
                  'aa' => date('Y-m-d H:i:s'),
                  'dd' => null,
                  'blood' => $pblood,
                  'room' => $_POST['proom'],
                  'fee' => 0,
                  'c_id' => $clinic_id]);

  $dbconnect->closeConnection();
} else {
  header("Location: ./add_patient.php");
}

?>
