<?php
/* This is the user_edit file. This file lists all the suers, and displays a button beside it
 * Click the button to edit the user.
*/
include 'UserController.php';

$settings = include '/var/www/mvc_demo.ini.php';

if (isset($_POST['save_user'])) {
	$user_array		= array();
	$user_id 		= $_POST['user_id'];
	$username 		= $_POST['username'];
	$password 		= $_POST['password'];
	$e_mail 		= $_POST['e_mail'];
	$access_level 	= $_POST['access_level'];
	$active 		= $_POST['active'];
	
	# Add the variables at the end of the $user_array
	array_push($user_array, $user_id, $username, $password, $e_mail, $access_level, $active);
	
	# Instantiate a new instance of the UserController
	$save_user = new UserController();
	$result = $save_user->save_user($user_array);	
		
}

if (isset($_POST['edit_user'])) {
	$user_id = $_POST['id'];
	
	$edit_user = new UserController();
	$result = $edit_user->edit_user($user_id);

	echo "<form method='post'>";
	echo "<p></p>User id :".$result[0][id]."</p>";
	echo "<p>Username : <input type='text' name='username' value='".$result[0][username]."' />"."</p>";
	echo "<p>Password : <input type='text' name='password' value='' />"."</p>";
	echo "<p>E-mail : <input type='text' name='e_mail' value='".$result[0][e_mail]."' />"."</p>";	
	echo "<p>Access level : <input type='text' name='access_level' value='".$result[0][access_level]."' />"."</p>";	
	echo "<p>Active : <input type='text' name='active' value='".$result[0][active]."' />"."</p>";	
	echo "<input type='hidden' name='user_id' value='".$result[0][id]."' />";
	echo "<p><input type='submit' name='save_user' value='Save' /></p>";
	echo "</form>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $settings[site_title]; ?></title>	
</head>
<body>
<?php
$count_all = new UserController();
echo "<p>Edit user</p>";
echo "I found: ".$count_all->count_users();

$list_all_usernames = new UserController();
echo "<p>This are the users:</p>\n";

$data = $list_all_usernames->list_user_names();
for ($i=0;$i<count($data);$i++) {
	$user_name = $data;
}

for ($i=0;$i<count($data);$i++) {
	echo "<form method='post'>";
	echo $user_name[$i][id].": ".$user_name[$i][username]." - ".$user_name[$i][e_mail]." - ".
	$user_name[$i][access_level]." - ".$user_name[$i][active];
	echo "<input type='hidden' name='id' value='".$user_name[$i][id]."' />";
	echo "<input type='submit' name='edit_user' value='Edit' /><br />";
	echo "</form>\n";
}
?>
</body>
</html>
