<?php
require_once "./connect.php";
require_once "./auth.php";
?>

<html>
<body>

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



<div class="col-md-6">
<div class="card">
<div class="card-header">New Treatment for id: <?php echo $_POST['treat']; ?></div>
<div class="card-body">


	<form class="form-horizontal" action="add_treat.php" method="post" enctype="multipart/form-data">
	<div class="form-group row">
	<div class="col-md-9">
	</div>
	</div>

	<div class="form-group row">
	<label class="col-md-3 col-form-label" for="diag">Diagnosis</label>
	<div class="col-md-9">
	<textarea class="form-control" id="diag" name="diag" rows="9" placeholder="Content.."></textarea>
	</div>
	</div>

	<div class="form-group row">
	<label class="col-md-3 col-form-label" for="trt">Treatment</label>
	<div class="col-md-9">
	<textarea class="form-control" id="trt" name="trt" rows="9" placeholder="Content.."></textarea>
	</div>
	</div>
	<div class="form-group row">
	<label class="col-md-3 col-form-label" for="mdc">Medicine</label>
	<div class="col-md-9">
	<select class="form-control" id="mdc" name="mdc">

	<?php
	try{
		$dbconnect = new Connection();
		$db = $dbconnect->openConnection();
	}catch(PDOException $error){
		echo "<p id='connerror'>A connection error has occured.<br>Please contact us.<br>Error code: </p>" . $error->getMessage();
		$dbconnect->closeConnection();
	}

	$query = $db->prepare("SELECT name FROM medications WHERE clinic_id = :c_ID AND quantity>0");
	$query->execute(['c_ID' => $clinic_id]);
	$result = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach ($result as $index=>$row) {
		echo "<option value=". $row['name'] .">". $row['name'] ."</option>";
	}
	 ?>

	</select>
	</div>
	</div>

</div>
<div class="card-footer">
<button class="btn btn-sm btn-primary" type="submit">
<i class="fa fa-dot-circle-o"></i>Submit</button>
</div>
</form>
</div>
</main>
</div>

</body>
</html>
