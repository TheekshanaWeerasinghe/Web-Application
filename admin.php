<?php
error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./images/" . $filename;
	$iname = $_POST["txtname"];
	$idescription = $_POST["txtdescription"];
	$iprice = $_POST["txtprice"];
	$link = $_POST["txtcategory"];
	$type = $_POST["type"];

	$db = mysqli_connect("localhost", "root", "", "Manga");

	if($type == 'product')
	{
	// Get all the submitted data from the form
    $sql = "INSERT INTO 'product' (Image) VALUES ('$filename')";
	//$sql = "INSERT INTO `product`( `filename`, `name`, `category`, `description`, `quantity`, `price`) VALUES ('".$filename."','".$iname."','".$icategory."','".$idescription."',".$iquantity.",'".$iprice."')";
	$sql = "INSERT INTO `product`(`Name`, `Image`, `description`, `link`, `price`) VALUES ('".$iname."','".$folder."', '".$idescription."','".$link."','".$iprice."')";
	}
	else if ($type == 'upcoming')
	{
		$sql = "INSERT INTO 'comming' (Image) VALUES ('$filename')";
		//$sql = "INSERT INTO `product`( `filename`, `name`, `category`, `description`, `quantity`, `price`) VALUES ('".$filename."','".$iname."','".$icategory."','".$idescription."',".$iquantity.",'".$iprice."')";
		$sql = "INSERT INTO `comming`(`Name`, `Image`, `description`, `link`, `price`) VALUES ('".$iname."','".$folder."', '".$idescription."','".$link."','".$iprice."')";
	}

	// Execute query
	mysqli_query($db, $sql);


	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Image uploaded successfully!</h3>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<style>
		*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

#content{
	width: 50%;
	justify-content: center;
	align-items: center;
	margin: 20px auto;
	border: 1px solid #cbcbcb;
}
form{
	width: 50%;
	margin: 20px auto;
}

#display-image{
	width: 100%;
	justify-content: center;
	padding: 5px;
	margin: 15px;
}
img{
	margin: 5px;
	width: 350px;
	height: 250px;
}


	</style>
</head>

<body>
	<div id="content">
		<form method="POST" action="" enctype="multipart/form-data">
			
			
			
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="txtname" id="txtname">
			</div>
			
			<div class="form-group">
				<label>Link</label>
				<input type="text" name="txtcategory" id="txtcategory">
			</div>
			
			<div class="form-group">
				<label>Drescription</label>
				<input type="text" name="txtdescription" id="txtdescription">
			</div>

			
			<div class="form-group">
				<label>Price</label>
				<input type="number" name="txtprice" id="txtprice">
			</div>

			<div class="form-group">
				<label>Type</label>
				<select name="type" id="type">
					<option value="product">product</option>
					<option value="upcoming">upcoming</option>
				</select>
			</div>
			
			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" value="" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
			</div>
		</form>
	</div>


	<div id="display-image">
		<?php
		$query = " select * from product ";
		$result = mysqli_query($db, $query);

		while ($data = mysqli_fetch_assoc($result)) {
		?>
			<img src="./images/<?php echo $data['filename']; ?>">
         
		<?php
		}
		?>
	</div>
</body>

</html>


