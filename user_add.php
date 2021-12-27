<?php
/* This is the USER_ADD file. This is the file that interacts with the user, and
 * displays all the data from the controller
*/
include 'UserController.php';

$settings = include '/var/www/mvc_demo.ini.php'; # Read settings file

if (isset($_POST['add_user'])) {
	$user_array = array();				# Define an array to hold the new user data
	$username 		= $_POST['username'];		# Assign variables from the form
	$password 		= $_POST['password'];
	$e_mail 		= $_POST['e_mail'];
	$access_level 	= 1;
	$active 		= 1;
	
	# Add the variables at the end of the $user_array
	array_push($user_array, $username, $password, $e_mail, $access_level, $active);
	
	# Instantiate a new instance of the UserController
	$add_user = new UserController();
	$result = $add_user->add_user($user_array);
	echo $result;
}// End isset

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $settings[site_title]; ?></title>	
</head>
<body>
<p>Add user to database</p>

<form method="post">
<p>Username: <input type="text" name="username" /></p>
<p>Password: <input type="text" name="password" /></p>
<p>E-mail: <input type="text" name="e_mail" /></p>
<p><input type="submit" name="add_user" value="add" /></p>

</form>
<?php
$count_all = new UserController();
echo "<p>Count users</p>";
echo "I found: ".$count_all->count_users();

$list_all_usernames = new UserController();
echo "<p>This are the users:</p>";

$data = $list_all_usernames->list_user_names();
for ($i=0;$i<count($data);$i++) {
	$user_name = $data;
}
for ($i=0;$i<count($data);$i++) {
	echo $user_name[$i][id].": ".$user_name[$i][username]." - ".$user_name[$i][e_mail]." - ".
	$user_name[$i][access_level]." - ".$user_name[$i][active]."<br />";
}


?>
</body>
</html>
