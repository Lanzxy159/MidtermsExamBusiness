<?php

function checklogin($pdo, $username, $password) {
    $sql = "SELECT *, CONCAT(first_name, ' ', last_name) AS full_name FROM business_admins WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $user['password'] === $password) {
        $_SESSION['admin_id'] = $user['admin_id'];
        $_SESSION['admin_full_name'] = $user['full_name'];
        return $user; 
    }
    return false; 
}


function addAdmin($pdo, $First_name, $Last_name, $username, $password){
    $sql = "INSERT INTO business_admins (First_name, Last_name, username, 
    password) VALUES(?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$First_name, $Last_name, $username, $password]);
    if ($executeQuery) {
        return true;
    }

}


function getBusinessCategory($pdo,$business_cat_id){
    $sql = "SELECT * FROM business_application WHERE business_cat_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$business_cat_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}
function seeAllBusinessCategory($pdo) {
    $sql = "
        SELECT 
            business_application.business_cat_id AS `business_cat_id`,
            business_application.business_cat AS `business_cat`,
            business_application.created_at AS `created_at`,
            business_application.updated_at AS `updated_at`,
        CONCAT(created_admin.first_name, ' ', created_admin.last_name) AS `created_by_full_name`,
        CONCAT(updated_admin.first_name, ' ', updated_admin.last_name) AS `updated_by_full_name`
        FROM 
            business_application
        LEFT JOIN 
            business_admins AS created_admin ON business_application.created_by = created_admin.admin_id
        LEFT JOIN 
            business_admins AS updated_admin ON business_application.updated_by = updated_admin.admin_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}


function getBusinessDetails($pdo,$business_cat_id){
    $sql = "SELECT * FROM business_application WHERE business_cat_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$business_cat_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}
function insertNewCategory($pdo, $categoryName, $adminId) {
    $sql = "INSERT INTO business_application (business_cat, created_by) VALUES(?, ?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$categoryName, $adminId]);
    if ($executeQuery) {
        return true; 
    }
    return false; 
}

function getBusinessbyId($pdo, $Business_id) {
    $sql = "SELECT 
                business_details.Business_id AS Business_id,
                business_details.Business_owner AS Business_owner,
                business_details.Business_name AS Business_name,
                business_details.Branch AS Branch,
                business_application.business_cat AS Business_Category
            FROM business_details
            JOIN business_application ON business_application.business_cat_id = business_details.business_cat_id
            WHERE business_details.Business_id = ? 
            GROUP BY business_details.Business_name";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$Business_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
    return null; 
}

function updateBusinessDetails($pdo, $business_id, $business_owner, $business_name, $branch, $admin_id) {
    $sql = "UPDATE business_details SET Business_owner = ?, Business_name = ?, Branch = ?, updated_by = ?, updated_at = NOW() WHERE Business_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$business_owner, $business_name, $branch, $admin_id, $business_id]);
    if ($executeQuery) {
        return true;
    }
    return false;
}
function insertIntoUsersRecords($pdo, $businessOwner, $businessName, $branch, $categoryId, $adminId){
    $sql = "INSERT INTO business_details (Business_owner, Business_name, Branch, business_cat_id, created_by) 
            VALUES(?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$businessOwner, $businessName, $branch, $categoryId, $adminId]);

    if ($executeQuery) {
        return true;
    }

    return false;
}

function updateCategory($pdo, $business_cat, $business_cat_id, $admin_id) {
    $sql = "UPDATE business_application 
            SET business_cat = ?, updated_by = ?, updated_at = NOW() 
            WHERE business_cat_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$business_cat, $admin_id, $business_cat_id]);
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false; 
    }
}


function deleteCategory($pdo,$business_cat_id){
    $sql = "DELETE FROM business_application WHERE business_cat_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$business_cat_id]);
	if ($executeQuery) {
		return true;
	}
}




function deletebusiness($pdo, $Business_id){
    $sql = "DELETE FROM business_details WHERE Business_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$Business_id]);
	if ($executeQuery) {
		return true;
	}
}

function getBusiness_details($pdo, $business_cat_id) {
    $sql = "SELECT 
    business_details.Business_id AS `Business_id`,
    business_details.Business_owner AS `Business_owner`,
    business_details.Business_name AS `Business_name`,
    business_details.Branch AS `Branch`,
    business_details.business_cat_id AS `business_cat_id`,
    business_application.business_cat AS `business_cat`,
    business_details.created_at AS `created_at`,
    business_details.updated_at AS `updated_at`,
    CONCAT(updated_admin.first_name, ' ', updated_admin.last_name) AS `updated_admin_full_name`,
    CONCAT(created_admin.first_name, ' ', created_admin.last_name) AS `created_admin_full_name`
    FROM business_details
    JOIN business_application 
        ON business_details.business_cat_id = business_application.business_cat_id
    LEFT JOIN business_admins AS updated_admin 
        ON business_details.updated_by = updated_admin.admin_id
    LEFT JOIN business_admins AS created_admin 
        ON business_details.created_by = created_admin.admin_id
    WHERE business_details.business_cat_id = ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$business_cat_id]);

    if ($executeQuery) {
    return $stmt->fetchAll(); 
    }
    return []; 
}

?>
