#Ajax Login form
This is a work-in-progress simple login form built with Ajax, PDO and PHP session. jQuery is used for the Ajax requests and Bootstrap is used for styling.

##Installation
* Clone the repo: <span style="color:green">`$`</span> `git clone https://github.com/JompaGlitter/ajax-login-form`
* Add database connection details in the top of php/login.php
* Create database table `users` if it doesn't exist and create columns `id` and `name` within.
* Create database table `passwords` if it doesn't exist and create columns `id`, `user_id` and `password` within.
* Store some user names and passwords and you're good to go.

###Important:
The database connection will request the password based on the user id of the supplied name if the name is valid. Therefore make sure that `users.id` matches `passwords.user_id` when storing user information, otherwise the request will fail.

##Note
The database connection is built with PDO and uses the [PDO::prepare()][1] and [PDO::execute()][2] to protect against SQL injection attacks. In this case though the password is assumed to be stored in plain text which of course is not optimal or secure at all. A better way to do it is to use [password_hash][3] on the plain text password and the [password_verify][4] for verification when logging in.

[1]: http://php.net/manual/en/pdo.prepare.php "PDO::prepare() on php.net"
[2]: http://php.net/manual/en/pdostatement.execute.php "PDO::execute() on php.net"
[3]: http://php.net/manual/en/function.password-hash.php "password_hash() on php.net"
[4]: http://php.net/manual/en/function.password-verify.php "password_verify() on php.net"