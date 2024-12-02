<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertApplicantBtn'])) {
    $currentUserID = getUserIDByUsername($pdo, $_SESSION['username']);
    $addedBy = $currentUserID;

    $insertApplicant = insertNewApplicant($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['age'], $_POST['email'], $_POST['phone_number'], $_POST['position'], $addedBy);

    if ($insertApplicant['status'] == '200') {
        $_SESSION['message'] = $insertApplicant['message'];
        $_SESSION['status'] = $insertApplicant['status'];
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = $insertApplicant['message'];
        $_SESSION['status'] = $insertApplicant['status'];
        header("Location: ../insert.php");
    }
}

if (isset($_POST['editApplicantBtn'])) {
    $currentUserID = getUserIDByUsername($pdo, $_SESSION['username']);
    $modifiedBy = $currentUserID;

    $editApplicant = editApplicant($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['age'], $_POST['email'], $_POST['phone_number'], $_POST['position'], $_GET['id'], $modifiedBy);

    if ($editApplicant['status'] == '200') {
        $_SESSION['message'] = $editApplicant['message'];
        $_SESSION['status'] = $editApplicant['status'];
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = $editApplicant['message'];
        $_SESSION['status'] = $editApplicant['status'];
        header("Location: ../edit.php");
    }
}

if (isset($_POST['deleteApplicantBtn'])) {
	$deleteApplicant = deleteApplicant($pdo,$_GET['id']);

	if ($deleteApplicant['status'] == '200') {
        $_SESSION['message'] = $deleteApplicant['message'];
        $_SESSION['status'] = $deleteApplicant['status'];
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = $deleteApplicant['message'];
        $_SESSION['status'] = $deleteApplicant['status'];
        header("Location: ../delete.php");
    }
}

if (isset($_GET['searchBtn'])) {
    $keyword = $_GET['keyword'];
    $username = $_SESSION['username'];
    logSearchQuery($pdo, $keyword, $username);
    $searchForAnApplicant = searchForAnApplicant($pdo, $keyword, $username);
}

if (isset($_POST['insertNewUserBtn'])) {
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);

	if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {

		if ($password == $confirm_password) {

			if (validatePassword($password)) {
				$insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT));

				if ($insertQuery['status'] == '200') {
					$_SESSION['message'] = $insertQuery['message'];
					$_SESSION['status'] = $insertQuery['status'];
					header("Location: ../login.php");
				}

				else {
					$_SESSION['message'] = $insertQuery['message'];
					$_SESSION['status'] = $insertQuery['status'];
					header("Location: ../register.php");
				}
			}

			else {
				$_SESSION['message'] = "Password should be more than 8 characters and should contain both uppercase, lowercase, and numbers.";
				$_SESSION['status'] = "400";
				header("Location: ../register.php");
			}

		}

		else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			$_SESSION['status'] = "400";
			header("Location: ../register.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = "400";
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = checkIfUserExists($pdo, $username);

		if ($loginQuery['status'] == '200') {
			$usernameFromDB = $loginQuery['userInfoArray']['username'];
			$passwordFromDB = $loginQuery['userInfoArray']['password'];

			if (password_verify($password, $passwordFromDB)) {
				$_SESSION['username'] = $usernameFromDB;
				header("Location: ../index.php");
			}
			
			else {
				$_SESSION['message'] = "Please try again, the password you entered is incorrect";
				$_SESSION['status'] = "400";
				header("Location: ../login.php");
			}
			
		}

	}

	else {
		$_SESSION['message'] = "Please make sure no input fields are empty";
		$_SESSION['status'] = "400";
		header("Location: ../login.php");
	}
}

if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../login.php");
}

?>