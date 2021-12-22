<?php

class User extends Dbh {

	public function create_user_table() {
		$sql = "CREATE TABLE tbl_user (
				id INT NOT NULL AUTO_INCREMENT,
				username VARCHAR(30) NOT NULL,
				e_mail VARCHAR(30) NOT NULL,
				password VARCHAR(100) NOT NULL,
				access_level VARCHAR(3) NOT NULL DEFAULT '1',
				active VARCHAR(2) NOT NULL DEFAULT '1',
				PRIMARY KEY(id))
				ENGINE = InnoDB DEFAULT CHARSET='utf8'";

		$this->connect_to_db()->query($sql);

	echo "Table has been created successfully.";	
	} // End create_query_table

	public function view_user_table() {
		$sql = "DESCRIBE tbl_user";
		$result = $this->connect_to_db()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			for ($i=0;$i<$numRows;$i++) {
			echo $data[$i][Field]."<br>";
			}
		}
		else {
			echo "The table does not exists or is empty.";
		}	
	} // End view_query_table

	public function delete_user_table() {
		$sql = "DROP TABLE tbl_user";
		$this->connect_to_db()->query($sql);
	} // End delete_query_table

	public function add_new_user($username, $password, $e_mail) {
		$username = $this->connect_to_db()->real_escape_string($_POST['username']);
		$password = $this->connect_to_db()->real_escape_string($_POST['password']);
		$password = md5($password);
		$e_mail = $this->connect_to_db()->real_escape_string($_POST['e_mail']);
		$access_level = 1;
		$active = 1;
		
		// Check to see if username already exists
		$sql_check_username = "SELECT username FROM tbl_user WHERE username LIKE '$username'";
		$result = $this->connect_to_db()->query($sql_check_username);
		$numRows = $result->num_rows;
			if ($numRows > 0) {
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
			echo "User aldreay exsists.";
			return;
			}
		$sql = "INSERT INTO tbl_user (username, password, e_mail, access_level, active) 
				VALUE ('$username','$password','$e_mail','$access_level','$active')";	
		$result = $this->connect_to_db()->query($sql);
		if($result) {
			echo "User successfully added to the table.";
			return;
		}
		else {
			echo "Not OK<br>Username or e-mail address are already registered.<br>Table created?";
		}	
	} // End insert_user_data

	public function update_user($userid, $username, $password, $e_mail, $access_level, $active) {
		$username = $_POST['username'];
		$password = $this->connect_to_db()->real_escape_string($_POST['password']);
		$e_mail = $this->connect_to_db()->real_escape_string($_POST['e_mail']);
		$access_level = $this->connect_to_db()->real_escape_string($_POST['access_level']);
		$active = $this->connect_to_db()->real_escape_string($_POST['access_level']);
		if ($password == '') {
			echo "Password is required!";
			return;
		}
		else {	
			$password = md5($password);
			$sql_update_user = "UPDATE tbl_user
					SET password='$password', e_mail='$e_mail', access_level='$access_level', active='$active'
					WHERE id='$userid'";
			
			$result = $this->connect_to_db()->query($sql_update_user);
			if ($result) {
				echo "<p>User updated succesfully.</p>";
			}
			else {
				echo "<p>User did not update.</p>";
			}	
		}	
	} // End update_user($userid, $username, $password, $e_mail, $access_level, $active);

	public function list_all_users() {
		$sql = "SELECT * FROM tbl_user";
		$this->connect_to_db()->query($sql);
		$result = $this->connect_to_db()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			// Raw output of the users table
			echo "<pre>"; 
			print_r ($data);
			echo "</pre>";
			return;
		}	
	} // End list_all_users()

	public function edit_user_data() {
		$sql = "SELECT * FROM tbl_user";
		$this->connect_to_db()->query($sql);
		$result = $this->connect_to_db()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			for ($i=0;$i<$numRows;$i++) {
				echo "\n<form method='post' action='user_admin.php'>";
				echo $data[$i][id]." - ";
				echo $data[$i][username]." - ";
				echo "<input type='submit' name='edit_user_details' value='Edit' />";
				echo "<input type='hidden' name='userid' value=".$data[$i][id]." />";
				echo "<input type='hidden' name='username' value=".$data[$i][username]." />";
				echo "<input type='hidden' name='password' value=".$data[$i][password]." />";
				echo "<input type='hidden' name='e_mail' value=".$data[$i][e_mail]." />";
				echo "<input type='hidden' name='access_level' value=".$data[$i][access_level]." />";
				echo "<input type='hidden' name='active' value=".$data[$i][active]." />";
				echo "</form>\n";
			}
			return;
		}		
	} // End edit_user_data

	public function delete_user_data() {
		$sql = "SELECT * FROM tbl_user";
		$this->connect_to_db()->query($sql);
		$result = $this->connect_to_db()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			for ($i=0;$i<$numRows;$i++) {
				echo "\n<form method='post' action='user_admin.php'>";
				echo $data[$i][id]." - ";
				echo $data[$i][username]." - ";
				echo "<input type='submit' name='delete_user_details' value='Delete' />";
				echo "<input type='hidden' name='userid' value=".$data[$i][id]." />";
				echo "</form>\n";
			}
			return;
		}	
	} // End delete_user_data

	public function delete_user_details($userid){
		$sql = "DELETE FROM tbl_user WHERE id='$userid'";
		$this->connect_to_db()->query($sql);
		echo " Done ";	
	} // end delete_user_details($userid)

	
	
} // End Class User


?>
