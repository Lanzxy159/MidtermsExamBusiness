<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="editbusinesscategory.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="homepage.php" class="home-link">Return to Category</a>
            <h1>Edit Category</h1>
        </header>

        <?php $getBusinessCategory = getBusinessCategory($pdo, $_GET['business_cat_id']); ?>

        <form action="core/handleForms.php" method="POST" class="edit-category-form">
            <input type="hidden" name="business_cat_id" value="<?php echo $_GET['business_cat_id']; ?>">
            <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">

            <div class="form-group">
                <label for="Category">Category</label>
                <input type="text" name="business_cat" value="<?php echo $getBusinessCategory['business_cat']; ?>" required>
            </div>

            <div class="form-group">
                <input type="submit" name="editCategory" value="Update Category" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>
