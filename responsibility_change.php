<?php
require_once "./connect.php";
require_once "./auth.php";


if(isset($_POST['nedit']) && isset($_POST['oedit'])) {
  try{
    $dbconnect = new Connection();
    $db = $dbconnect->openConnection();
  }catch(PDOException $error){
    echo "<p id='connerror'>A connection error has occured.<br>Please contact us.<br>Error code: </p>" . $error->getMessage();
    $dbconnect->closeConnection();
  }

  $query = $db->prepare("UPDATE responsibles SET nurse_id = :new_id WHERE room_number = :new_number and room_clinic_id = :c_ID");
  $query->execute(['new_id' => $_POST['nedit'],
                   'new_number' => $_POST['oedit'],
                   'c_ID' => $clinic_id]);
}

header("Location: nurse_edit_rooms.php");

?>
