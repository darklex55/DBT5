<?php
Class Connection {
    // Change these accordingly
	private $server = "mysql:host=localhost;dbname=lab1920omada5_webapp;charset=utf8";
	private $user = "lab1920omada5"; //"lab1920omada5"; //"root";
	private $pass = "okontopidisapantisestonalex"; //"okontopidisapantisestonalex"; //"";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES, false);

	protected $connection;

    public function openConnection() {
    	try {
			$this->connection = new PDO($this->server, $this->user,$this->pass,$this->options);

          	return $this->connection;
        } catch(PDOException $error) {
            die("Unable to connect to the database. " . $error->getMessage());
        }
 	}

	public function closeConnection() {
        try {
			$this->connection = null;
        } catch(PDOException $error) {
            die("Error while disconnecting from the database " . $error->getMessage());
        }
  	}
}
?>
