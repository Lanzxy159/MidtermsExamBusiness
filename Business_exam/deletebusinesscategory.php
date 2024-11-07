<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
    <link rel="stylesheet" href="deletebusinesscategory.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="homepage.php" class="home-link">Return to Category</a>
            <h1>Are you sure you want to delete this Category?</h1>
        </header>

        <?php 
        $getBusinessCategory = getBusinessCategory($pdo, $_GET['business_cat_id']); 
        ?>

        <div class="category-details">
            <h2>Category ID: <?php echo $getBusinessCategory['business_cat_id']; ?></h2>
            <h2>Category Name: <?php echo $getBusinessCategory['business_cat']; ?></h2>
        </div>

        <div class="delete-action">
            <form action="core/handleForms.php?business_cat_id=<?php echo $_GET['business_cat_id']; ?>" method="POST">
                <input type="submit" name="deleteCategory" value="Delete" class="delete-btn">
            </form>
        </div>
    </div>
</body>
</html>
