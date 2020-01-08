<?php
require_once "./connect.php";
require_once "./auth.php";



?>
<html>
<body>
	<?php
	if(isset($_POST['diag']) && isset($_POST['tst'])) {
	echo $_POST['diag'];
	echo $_POST['tst'];
	echo $_POST['mdc'];

}
?>
</body>
</html>
