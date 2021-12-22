Readme.md

This is a demoversion of how you cna make a small php system with classes to connect and interact with a mySQL database. It's just the basic,and are ment for a proof of concept. The 
class_test.php file has the logon credentials for the database. This file is read each time the Dbh class is called and instantiated. The return value from the file is an array that
holds alle the logondata needed to interact with the mySQL database.


Files
class_test.php
This file holds the overall  configuration.

'server' => 'localhost',
'user' => 'username',
'passwd' => 'password',
'dbase' => 'db_class_test',
'site_title' => 'Class tests'

dbh.php
This is the class that does the actual connection to the mysql server and database.

user.php
This is the user-class file. Here are all the CRUD functions for the database.

user_admin.php
This file handles what you see. A supersimple submit-button menu.
