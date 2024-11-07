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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Details</title>
    <link rel="stylesheet" href="viebusinessstyles.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="homepage.php" class="home-link">Return to Home</a>
            <h1>Welcome, Admin ID: <?php echo $admin_id; ?> <?php echo $admin_full_name; ?></h1>
        </header>

        <div class="form-container">
    <form action="core/handleForms.php" method="POST">
        <div class="form-group">
            <label for="business_owner">Business Owner</label> 
            <input type="text" name="business_owner" required>
        </div>

        <div class="form-group">
            <label for="business_name">Business Name</label> 
            <input type="text" name="business_name" required>
        </div>

        <div class="form-group">
            <label for="business_branch">Branch</label> 
            <input type="text" name="business_branch" required>
        </div>

        <div class="form-group">
            <?php 
            $business_cat_id = $_GET['business_cat_id']; 
            $getBusinessDetails = getBusinessDetails($pdo, $business_cat_id); 
            $business_cat = $getBusinessDetails['business_cat']; 
            ?>
            <label for="business_category">Business Category</label>
            <select name="business_category" id="businessCategory" required>
                <option value="<?php echo $business_cat_id; ?>"><?php echo $business_cat; ?></option>
            </select>
        </div>
        <input type="hidden" name="business_cat_id" value="<?php echo $business_cat_id; ?>">

        <div class="form-group">
            <input type="submit" name="insertBusinessDetails" value="Submit">
        </div>
    </form>
</div>


        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Business ID</th>
                        <th>Business Owner</th>
                        <th>Business Name</th>
                        <th>Branch</th>
                        <th>Category</th>   
                        <th>Category ID</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $getBusiness_details = getBusiness_details($pdo, $_GET['business_cat_id']);
                    foreach ($getBusiness_details as $row) { 
                    ?>
                    <tr>
                        <td><?php echo $row['Business_id']; ?></td>
                        <td><?php echo $row['Business_owner']; ?></td>
                        <td><?php echo $row['Business_name']; ?></td>
                        <td><?php echo $row['Branch']; ?></td>
                        <td><?php echo $row['business_cat']; ?></td>
                        <td><?php echo $row['business_cat_id']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['created_admin_full_name']; ?></td>
                        <td><?php echo $row['updated_at']; ?></td>
                        <td><?php echo $row['updated_admin_full_name']; ?></td>
                        <td>
                            <a href="editbusinessdetails.php?Business_id=<?php echo $row['Business_id']; ?>&business_cat_id=<?php echo $_GET['business_cat_id']; ?>">Edit</a>
                            <a href="deletebusinessdetails.php?Business_id=<?php echo $row['Business_id']; ?>&business_cat_id=<?php echo $_GET['business_cat_id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
