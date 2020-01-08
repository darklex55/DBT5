<?php
require_once "./connect.php";
require_once "./auth.php";


if(isset($_POST['discharge'])) {
	try{
		$dbconnect = new Connection();
		$db = $dbconnect->openConnection();
	}catch(PDOException $error){
		echo "<p id='connerror'>A connection error has occured.<br>Please contact us.<br>Error code: </p>" . $error->getMessage();
		$dbconnect->closeConnection();
	}

	$query = $db->prepare("UPDATE patients SET discharge_date = :pdddate WHERE patient_code = :pcode AND patient_clinic_id = :c_ID");
	$query->execute(['pcode' => $_POST['discharge'],
									 'pdddate' => date("Y-m-d"),
								   'c_ID' => $clinic_id]);
}
header("Location: doctors_patients.php");
?>
