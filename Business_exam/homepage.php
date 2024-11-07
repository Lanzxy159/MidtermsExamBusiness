
<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php 
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ./index.php"); 
    exit();
}

$admin_id = $_SESSION['admin_id']; 
$admin_full_name = $_SESSION['admin_full_name']; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="homepagestyles.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
<body>
    <div class="container">
        <h1>Welcome, Admin ID: <?php echo $admin_id; ?> <?php echo $admin_full_name; ?> </h1>
        <form action="core/handleForms.php" method="POST">
            <input type="submit" value="Logout" name="logout_btn" class="logout-button">
        </form>

        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="category_name">Add Category Name</label>
                <input type="text" name="business_cat" required>
                <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                <input type="submit" name="insertBusinessCategory" value="Add Category">
            </p>
        </form>

        <table>
            <tr>
                <th>Category ID</th>
                <th>Business Category</th>
                <th>Created At</th>
                <th>Created By</th>
                <th>Updated At</th>
                <th>Updated By</th>
                <th>Actions</th>
            </tr>

			<?php $seeAllBusinessCategory = seeAllBusinessCategory($pdo); ?>
            <?php foreach ($seeAllBusinessCategory as $row) { ?>
            <tr>
                <td><?php echo $row['business_cat_id']; ?></td>
                <td><?php echo $row['business_cat']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td><?php echo $row['created_by_full_name']; ?></td>
                <td><?php echo $row['updated_at']; ?></td>
                <td><?php echo $row['updated_by_full_name']; ?></td>
                <td>
                    <a href="viewbusiness.php?business_cat_id=<?php echo $row['business_cat_id']; ?>&admin_id=<?php echo $_SESSION['admin_id']; ?>">View</a> |
                    <a href="editbusinesscategory.php?business_cat_id=<?php echo $row['business_cat_id']; ?>&admin_id=<?php echo $_SESSION['admin_id']; ?>">Edit</a> |
                    <a href="deletebusinesscategory.php?business_cat_id=<?php echo $row['business_cat_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
