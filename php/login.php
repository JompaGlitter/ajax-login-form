<?php

/*
 * TODO: fix positive output when pressing 'login' with empty form fields
 *
 */

/* Start session */
session_name('ajax_login');
session_start();

/*
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly
*/


/* Database connection details */
$host 		= 'localhost';
$user 		= 'root';
$pass 		= 'root';
$db 	 	= 'PDO';

$sql        = 'SELECT p.password AS password, u.name AS name
                    FROM passwords AS p
                    INNER JOIN users AS u
                    ON u.id = p.user_id
                    WHERE u.name = :name';


/* Get value of 'do' */
$do = isset($_GET['do']) ? $_GET['do'] : null;

switch ($do) {
	case 'login':
		if (isset($_SESSION['user'])) {
			$output = "You are already logged in as user: " . $_SESSION['user'];
		}
		else {
			/* Try connection and catch errors */
            try {
                $pdo = new PDO("mysql:host={$host};dbname={$db};charset=utf8;", $user, $pass);
            	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                 echo $e->getMessage();
            }

            /* Do database request */
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('name' => $_POST['name']));
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

			if (($_POST['name'] == $res['name']) && ($_POST['password'] == $res['password'])) {
                
                $_SESSION['user'] = $res['name'];
                $output = "You are now logged in as " . $res['name'];
                $result = "success";
            }
            else {
                $output = "Invalid username or password";
                $result = "warning";
            }
		}
		break;

	case 'logout':
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            $output = "You have successfully logged out.";
            $result = "success";
        }
        else {
            $output = "You have not logged in yet!";
        }
		break;

	case 'status':
		if (isset($_SESSION['user'])) {
            $output = "You are logged in as user: " . $_SESSION['user'];
        }
        else {
            $output = "You are not logged in.";
        }
		break;

	default:
		exit("This is not the result you are looking for...");
		break;
}



// Deliver response as a JSON object
header('Content-type: application/json');
echo json_encode(array('output' => $output, 'result' => $result));