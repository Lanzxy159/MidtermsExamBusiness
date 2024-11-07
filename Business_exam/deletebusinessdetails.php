<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	
	<?php $getBusinessbyId = getBusinessbyId($pdo, $_GET['Business_id']); ?>
	<h1>Are you sure you want to delete this business?</h1>
	<div class="container" style="border-style: solid; height: 400px;">

		<h2>Business Owner<?php echo $getBusinessbyId['Business_owner'] ?></h2>
		<h2>Business Name <?php echo $getBusinessbyId['Business_name'] ?></h2>
		<h2>Branch: <?php echo $getBusinessbyId['Branch'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?Business_id=<?php echo $_GET['Business_id']; ?>&business_cat_id=<?php echo $_GET['business_cat_id']; ?>" method="POST">
				<input type="submit" name="deletebusiness" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>