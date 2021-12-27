<?php
/* This is the MODEL file
 * It has all the connections with the databse
 */

class Database {
	private $servername;	# Placeholder for servername
	private $username;		# Placeholder for username
	private $password;		# Placeholder for password
	private $dbname;		# Placeholder for databasename
	
	// This function is called everytime the class is initiated
	function __construct() {
		$array = include '/var/www/mvc_demo.ini.php';			# Read the array in the class_test file. Placethis file outside the html/php files.
		foreach ($array as $key => $value) {		# Make an array with the elements from the file.
			$this->{$key} = $value;					# Make key and assign value
			$data[] = $value;						# Here is the end array
		}
		$this->servernsame 	= $data[0];				# The servername is at pos 0
		$this->username 	= $data[1];				# The username is at pos 1
		$this->password 	= $data[2];				# The password is at pos 2
		$this->dbname 		= $data[3];				# The databasename is at pos 3
	} // End of __construct
	
	// This function connects to the database. If there are any errors, they are displayed
	public function getConnection() {
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($conn->connect_error) {
			echo "Connection is NOT ok. ";
			die ("Connection failed:".$conn->connect_error);
		}
		else {	
			return $conn;
		}
	} // End function connect_to_db	
} // End class dbh
?>
