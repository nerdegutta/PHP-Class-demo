# PHP-Class-demo
This is a demoversion of how you can make a small registration with system with php and classes to connect and interact with a mySQL database. It's just the basic,and are ment for a proof of concept. The class_test.php file has the log in credentials for the database. This file is read each time the Dbh class is called and instantiated. The return value from the file is an array that holds alle the login data needed to interact with the mySQL database.

It's far from perfect, but it'll get you started.

Filenames have been changed, and a few new files have been added:

user_add.php

This is the view file for adding a user.


user_delete.php

This is the delete view for deleting a user.

user_edit.php

Edit a user.

uer_view.php

Vie a list of the users.

Database.php

This is the model fil in MVC

UserController.php

This is the controller file in MVC.


Files

class_test.php

This file holds the overall  configuration.

dbh.php

This is the class that does the actual connection to the mysql server and database.

user.php

This is the user-class file. Here are all the CRUD functions for the database.

user_admin.php

This file handles what you see. A supersimple submit-button menu.
