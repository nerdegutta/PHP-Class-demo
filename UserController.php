<?php

require_once 'Database.php';

class UserController extends Database {
	
	// This function returns the number of records in the database
	function count_users() {
		$db = new Database();							# Instantiate the Databse class 
		$sql_list_all = "SELECT * FROM tbl_user";		# Prepare the SQL query
		$connection = $db->getConnection();				
		$result = $connection->query($sql_list_all);	# Perform the query and populate $result
		if ($result->num_rows == 0) {					# Check the result
			return null;								# If not return null
		}
		else {
			return $result->num_rows;					# Return the number of records
		}	
	} // End list_users
	
	// This function returns an array with all the fields
	function list_user_names() {
		$db = new Database();								# Instantiate a new Database class
		$sql_list_usernames = "SELECT * FROM tbl_user";		# Prepare the SQL query
		$connection = $db->getConnection();					# Get connection
		$result = $connection->query($sql_list_usernames);	# Get the list of names
		$num_rows = $result->num_rows;						# Assign vlue to variable 
		if ($num_rows > 0) {
			while ($row = $result->fetch_assoc()) {			# Fetch as assoc list
				$data[] = $row;								# Populate the array
			} // End while
			return $data;									# Return the array to the view
		}
	} // End list_user_names
	
	// This add a new user to the database
	function add_user($user_array){
		$username 		= $user_array[0];		# The username is at place 0
		$password 		= md5($user_array[1]);	# Password is in place 1, and is encrypted
		$e_mail 		= $user_array[2];
		$access_level 	= $user_array[3];
		$active 		= $user_array[4];
		
		// Prepare a statement to see if username is already in database
		$sql_check_username = "SELECT username FROM tbl_user WHERE username LIKE '%$username%';";
		$res_username = $this->getConnection()->query($sql_check_username);
		
		// Prepare statement to see if e_mailis already in the database
		$sql_check_email = "SELECT e_mail FROM tbl_user WHERE e_mail LIKE '%$e_mail%';";
		$res_email = $this->getConnection()->query($sql_check_email);

		// Perform the check
		if (($res_username->num_rows > 0) || ($res_email->num_rows > 0))
		{
			return "Username or e-mail aready in database."; # IF username & e_mail are allready used
		}

		// If not => the user is added
		$sql_add_user = "INSERT INTO tbl_user (username, password, e_mail, access_level, active)
						VALUE ('$username','$password','$e_mail','$access_level','$active');";
		$result = $this->getConnection()->query($sql_add_user);
		if ($result) {
			return "OK";
		}
	} // End add_user($user_array);
	
	// This function retrieves the user from the database, and sends the userdetails back to user_edit.php
	function edit_user($user_id) {
		echo "Edit user with ID ".$user_id."<br />";
		
		$sql_find_user = "SELECT * FROM tbl_user WHERE id LIKE '$user_id';";
		$result = $this->getConnection()->query($sql_find_user);
		echo $sql_find_user;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}			
	}
	
	// Function to save a new user
	function save_user($user_array) {

		$user_id 		= $user_array[0];
		$username 		= $this->getConnection()->real_escape_string($user_array[1]);
		$password 		= $this->getConnection()->real_escape_string($user_array[2]);
		$e_mail 		= $this->getConnection()->real_escape_string($user_array[3]);
		$access_level 	= $this->getConnection()->real_escape_string($user_array[4]);
		$active 		= $this->getConnection()->real_escape_string($user_array[5]);
		// Check if password is empty
		if ($password == '') {
			echo "<p>Password is required.</p>";
			return;
		}
		else {
			$password = md5($password);
			$sql_save_user = "UPDATE tbl_user SET
							username='$username', password='$password', e_mail='$e_mail', access_level='$access_level', active='$active'
							WHERE id='$user_id'";		
			$result = $this->getConnection()->query($sql_save_user);
			if ($result) {
				echo "<p>User updated.</p>";
			}
			else {
				echo "<p>Not updated.</p>";
			}
		}
	} // End save_user
	
	// This function deletes the user, based on the ID number
	function delete_user($id) {
		// Prepare the sql statement
		$sql_delete_user = "DELETE FROM tbl_user WHERE id='$id';";
		$result = $this->getConnection()->query($sql_delete_user);
		// Check if deletion wnet well
		if ($result) {
			echo "User is deleted";
		}
		else {
			echo "Error deleting user.";
		}
	}
} // End class userController
?>
