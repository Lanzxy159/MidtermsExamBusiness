<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php 
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ./index.php");
    exit();
}
$admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Business Details</title>
    <link rel="stylesheet" href="editbusinessdetails.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="viewbusiness.php?business_cat_id=<?php echo $_GET['business_cat_id']; ?>" class="home-link">View The Businesses</a>
            <h1>Edit the Businesses</h1>
        </header>

        <?php 
        $getBusinessbyId = getBusinessbyId($pdo, $_GET['Business_id']);
        ?>

        <div class="form-container">
            <form action="core/handleForms.php?business_cat_id=<?php echo $_GET['business_cat_id']; ?>&Business_id=<?php echo $_GET['Business_id']; ?>" method="POST">
                <div class="form-group">
                    <label for="Business_owner">Owner</label> 
                    <input type="text" name="Business_owner" value="<?php echo $getBusinessbyId['Business_owner']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="Business_name">Business Name</label> 
                    <input type="text" name="Business_name" value="<?php echo $getBusinessbyId['Business_name']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="Branch">Branch</label> 
                    <input type="text" name="Branch" value="<?php echo $getBusinessbyId['Branch']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="editDetails" value="Update Business">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
