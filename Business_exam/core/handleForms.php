<?php
require_once 'dbConfig.php';
require_once 'models.php';

session_start();
if (isset($_POST['login_button'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $query = checklogin($pdo, $username, $password);

        if ($query) {
            $_SESSION['admin_id'] = $query['admin_id'];
            $_SESSION['admin_id'] = $query['admin_id'];
            header("Location: ../homepage.php");
            exit();
        } else {
            $_SESSION['error'] = "Login failed. Please check your credentials and try again.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Make sure that all fields are filled.";
        header("Location: ../index.php");
        exit();
    }
}
if (isset($_POST['logout_btn'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['register_button'])) {
    header("Location: ../register.php");
}

if (isset($_POST['add_registerbtn'])) {
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (!empty($First_name) && !empty($Last_name)&& !empty($username) && !empty($password)) {
        $query = addAdmin($pdo, $First_name, $Last_name, $username, $password);
        if ($query) {
            header("Location: ../homepage.php");
            exit();
        } else {
            $_SESSION['error'] = "Register failed.";
            header("Location: ../register.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Make sure that all fields are filled.";
        header("Location: ../register.php");
        exit();
    }
}




if (isset($_POST['add_registerbtn'])) {
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (!empty($First_name) && !empty($Last_name)&& !empty($username) && !empty($password)) {
        $query = addAdmin($pdo, $First_name, $Last_name, $username, $password);
        if ($query) {
            header("Location: ../homepage.php");
            exit();
        } else {
            $_SESSION['error'] = "Register failed.";
            header("Location: ../register.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Make sure that all fields are filled.";
        header("Location: ../register.php");
        exit();
    }
}


if (isset($_POST['insertBusinessCategory'])){
    $business_category = trim($_POST['business_cat']);
    $admin_id =trim($_POST['admin_id']);
    if (!empty($business_category)) {
        $query = insertNewCategory($pdo, $business_category, $admin_id);
        if ($query) {
            header("Location: ../homepage.php");
            exit();
        } else {
            echo "Insert failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }

}



if (isset($_POST['editCategory'])) {
    $business_cat_id = $_POST['business_cat_id'];
    $business_cat = $_POST['business_cat'];
    $admin_id = $_POST['admin_id'];

    $updateSuccess = updateCategory($pdo, $business_cat, $business_cat_id, $admin_id);

    if ($updateSuccess) {
        header("Location: ../homepage.php");
        exit();
    } else {
        echo "Failed to update category.";
    }
}


if (isset($_POST['deleteCategory'])) {
	$query = deleteCategory($pdo, $_GET['business_cat_id']);

	if ($query) {
		header("Location: ../homepage.php");
	}

	else {
		echo "Delete failed";;
	}

}
if (isset($_POST['insertBusinessDetails'])) {
    $business_owner = trim($_POST['business_owner']);
    $business_name = trim($_POST['business_name']);
    $branch = trim($_POST['business_branch']);
    $business_cat_id = $_POST['business_category'];
    $admin_id = $_SESSION['admin_id']; 
    $insertIntoUsersRecords = insertIntoUsersRecords($pdo, $business_owner, $business_name, $branch, $business_cat_id, $admin_id);
    
    if ($insertIntoUsersRecords) {
        header("Location: ../homepage.php");
        exit();
    } else {
        echo "Failed to insert details.";
    }
}

if (isset($_POST['editDetails'])) {
    $business_id = $_GET['Business_id'];
    $business_owner = trim($_POST['Business_owner']);
    $business_name = trim($_POST['Business_name']);
    $branch = trim($_POST['Branch']);
    $business_cat_id = $_GET['business_cat_id'];
    $admin_id = $_SESSION['admin_id']; 

    if (!empty($business_owner) && !empty($business_name) && !empty($branch)) {
        $updateQuery = updateBusinessDetails($pdo, $business_id, $business_owner, $business_name, $branch, $admin_id);
        if ($updateQuery) {
            header("Location: ../viewbusiness.php?business_cat_id=" . $business_cat_id);
            exit();
        } else {
            echo "Update failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }
}




if (isset($_POST['deletebusiness'])) {
	$query = deletebusiness($pdo, $_GET['Business_id']);

	if ($query) {
		header("Location: ../viewbusiness.php?business_cat_id=".$_GET['business_cat_id']);
	}
	else {
		echo "Deletion failed";
	}
}




?>
