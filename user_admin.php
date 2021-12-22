<?php
// Include the necessary classes 
include 'dbh.php';
include 'user.php';

// Read the setting file with vital information
$settings = include '/var/www/class_test.php';

if (isset($_POST['create_user_table'])) {
	echo "Creating the user table.";
	$new_query_table = new User();
	$new_query_table->create_user_table();
} // End if isset create_query_table

if (isset($_POST['view_user_table'])) {
	echo "The user table:<br>";
	$show_query_table = new User();
	$show_query_table->view_user_table();
}// End if isset view_query_table

if (isset($_POST['delete_user_table'])) {
	echo "Deleting the user table.<br>";
	$show_query_table = new User();
	$show_query_table->delete_user_table();
}// End if isset view_query_table

if (isset($_POST['send'])) {
	$username = $_POST['username'];	
	$password = $_POST['password'];
	$password = md5($password);
	$e_mail = $_POST['e_mail'];		
		$add_user = new User();
		$add_user->add_new_user($username, $password, $e_mail);
} // End if isset send

if (isset($_POST['add_user_data'])) {
	echo "Add new user.<br>";
	?>
	<form method="post">
	<p>Username: <input type="text" name="username"></p>
	<p>Password: <input type="text" name="password"></p>
	<p>E-mail: <input type="text" name="e_mail"></p>
	<input type="Submit" name="send" value="Add">
	</form>
	<?php
}// End if isset view_query_table

if (isset($_POST['list_user_data'])) {
	echo "List all users.<br>";
	$list_all_users = new User();
	$list_all_users->list_all_users();
} // End list_user_data

if (isset($_POST['edit_user_data'])) {
	echo "<p>Edit user data.</p>";
	$edit_user_data = new User();
	$edit_user_data->edit_user_data();
} // End edit_user_data

if (isset($_POST['edit_user_details'])){
	echo "<p>Edit user details</p>";
	$userid 		= $_POST['userid'];
	$username 		= $_POST['username'];
	$e_mail 		= $_POST['e_mail'];
	$access_level 	= $_POST['access_level'];
	$active 		= $_POST['active'];
	
	// Show a form with the details for the actual user.
	echo "<form method='post'>";
	echo "<p>User Id: ".$userid."</p>\n";
	echo "<p>Username: ".$username."</p>\n";
	echo "<p>Password: <input type='password' name='password'></p>\n";
	echo "<p>E-mail: <input type='text' name='e_mail' value='".$e_mail."'></p>\n";
	echo "<p>Access level: <input type=text' name='access_level' value='".$access_level."'></p>\n";
	echo "<p>Active: <input type='text' name='active' value='".$active."'></p>\n";
	echo "<input type='hidden' name='userid' value='".$userid."'>";
	echo "<p><input type='Submit' name='update_user' value='Update user' /></p>\n";
	echo "</form>\n";
} // End if isset edit_user

if (isset($_POST['update_user'])) {
	$userid 		= $_POST['userid'];
	$username 		= $_POST['username'];
	$password 		= $_POST['password'];
	$e_mail 		= $_POST['e_mail'];
	$access_level 	= $_POST['access_level'];
	$active 		= $_POST['active'];
	$update_user = new User();
	$update_user->update_user($userid, $username, $password, $e_mail, $access_level, $active);
}// End update_user

if (isset($_POST['delete_user'])) {
	echo "<p>Delete a user.</p>";
	$delete_user = new User();
	$delete_user->delete_user_data();	
} // End delete_use

if (isset($_POST['delete_user_details'])) {
	$userid = $_POST['userid'];
	$delete_user_details = new User();
	$delete_user_details->delete_user_details($userid);
} // End delete_user_details

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $settings[site_title]; ?></title>
</head>
<body>
<form method="post">
<p>
	<input type="Submit" name="add_user_data" value="Add user to table" />
	<input type="Submit" name="edit_user_data" value="Edit user data" />
	<input type="Submit" name="list_user_data" value="List users" />
	<input type="Submit" name="delete_user" value="Delete user" />
</p>
<p>
	<input type="Submit" name="create_user_table" value="Create User table" />
	<input type="Submit" name="view_user_table" value="View User table fields" />
	<input type="Submit" name="delete_user_table" value="Delete User table" />
</p>
</form>
</body>
</html>
