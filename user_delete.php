<?php
/* 
 * This is the delete user file
*/
include 'UserController.php';

$settings = include '/var/www/mvc_demo.ini.php';

if (isset($_POST['delete_user'])) {
	$user_id = $_POST['id'];
	
	# Instantiate a new instance of the UserController
	$delete_user = new UserController();
	$delete_user->delete_user($user_id);

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
echo "<p>Delete user</p>";
echo "I found: ".$count_all->count_users();

$list_all_usernames = new UserController();
echo "<p>This are the users:</p>\n";

$data = $list_all_usernames->list_user_names();
for ($i=0;$i<count($data);$i++) {
	$user_name = $data;
}

for ($i=0;$i<count($data);$i++) {
	echo "<form method='post' id='MyForm'>";
	echo $user_name[$i][id].": ".$user_name[$i][username]." - ".$user_name[$i][e_mail]." - ".
	$user_name[$i][access_level]." - ".$user_name[$i][active];
	echo "<input type='hidden' name='id' value='".$user_name[$i][id]."' />";
	echo "<input type='submit' name='delete_user' value='Delete' /><br />";
	echo "</form>\n";

}
?>
</body>
</html>

