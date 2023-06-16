<?php 
include_once "DBController.php";
session_start();
$count = 0;
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
} else {
    $count++;
}
?>
<html>
    <head>
        <title>wishlist</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Owl-carousel CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <!-- font awesome icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

        <!-- Custom CSS file -->
        <link rel="stylesheet" href="wish.css">
        <style>
          .nav a:hover {
            color: #8f2424;
          }

          .nav img{
              max-width: 50px;
              max-height: 50px;
              margin-right: 650px;
              padding: 10px;
              margin-left: 50px;
              margin-top: 10px;
          }

          .nav div {
            display: inline-block;
            color: white;
            font-size: 20px;
            margin-left: 40px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

          </style>
    </head>
    <body>


      <div class="nav">
        <img src="./images/Logo.png">
        <div><a href="home.html">Home</a></div>
        <div><a href="product.php">Products</a></div>
        <div><a href="comming.php">Comming soon</a></div>
        <div><a href="wishlist.php"><span class="material-symbols-outlined">
          favorite
          </span></a></div>
          <div><a href="login.php"><span class="material-symbols-outlined">
            login
            </span></a></div>
      </div>


        <h1>wishlist</h1>

        <div class="cart-page">
          <table>
            <tr>
              <th>No</th>
              <th>Product</th>
              <th>Name</th>
              <th>Action</th>
            </tr>

            <?php

	    if(isset($_SESSION['cart']))
		{
      $con = mysqli_connect("localhost","root","","Manga");
                      
      if(!$con)
      {
        die("cannot connect to db server");
      }
      
		  foreach($_SESSION['cart'] as $key => $value)
		  {
	
			$id = $value['productID'];
			$quantity = $value['quantity'];
			$sql = "SELECT * FROM product WHERE productID IN ($id)";  
			$result=$con-> query($sql);
            if ($result-> num_rows > 0){
			while ($row=$result-> fetch_assoc()) {

		 
				
	if($_SERVER["REQUEST_METHOD"]=="POST")
     {	
	if(isset($_POST['remove']))
	{
		foreach($_SESSION['cart'] as $key => $value)
		{
			if($value['productID']==$_POST['productID'])
			{
			unset($_SESSION['cart'][$key]);
	        $_SESSION['cart']=array_values($_SESSION['cart']);
		?>
	        <script type="module">
			        window.location="wishlist.php";
		     </script>
           <?php
			}
	
		}
	}
		
}
$sr=$key+1;
	
			?>
            
            <tr>
            <td><?=$sr?></td>
            <td><img src='<?=$row["Image"]?>' width="100px" height="100px"> </td>
            <td><?=$row['Name']?></td>
            <form method="post" action="">
            <td>
              <button type="submit" class="remove_btn" name="remove">REMOVE</button>
              </td>	
              <input type="hidden" name="productID" value='<?=$id?>'>
                  </form>
            

			
			  </tr>  
        <?php
	
}
}
}
}




?>
     
            
          </table>       
        </div>	
          







    <div class="footer">
        <div class="foot">
        <h3>Information</h3>
        <a href="home.html"><li>Home</li></a>
        <a href="contact.html"><li>About us</li></a>
        <a href="contact.html"><li>Contact us</li></a>
        </div>

    </div>

    </body>
</html>