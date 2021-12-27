<?php
/* This is the USER_VIEW file. This is the file that interacts with the user, and
 * displays all the data from the controller
*/
include 'UserController.php';

$settings = include '/var/www/mvc_demo.ini.php';

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

