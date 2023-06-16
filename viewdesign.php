<?php
session_start();
include_once "DBController.php";
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>product details</title>
<link rel="stylesheet" href="design.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
        <!-- font awesome icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />


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


		
	
<?php
	$id ="";
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
	
    $con = mysqli_connect("localhost","root","","Manga");
                      
    if(!$con)
    {
      die("cannot connect to db server");
    }
	
     $sql="SELECT * from product where productID=$id";
	
		 $result=$con-> query($sql);	
		if ($result->num_rows > 0){
			$row = mysqli_fetch_assoc($result)
	?>
        <h1> <?=$row["Name"] ?></h1>

	
	<!--------- single product details---------->
	<div class="small-container single-product">
	 <div class="row">
		    <div class="col-1">
			 <form name='add' method="post" action="">
			 <img src='<? echo $row["Image"]?>' width="=450px" height="450px" border-radius="30px" id="product-img">
					
		    </div>
            


            <?php

	if(isset($_POST['addtocart']))
	{
		if(isset($_SESSION['cart']))
		{			
		   $myitems=array_column($_SESSION['cart'],'productID');

		   if(in_array($_POST['productID'],$myitems))
		    {
			  
		     	?>
             	 <script type="module">              	 
                alert("already in cart");
                 </script>
		        <?php		
	       	}
	   	   else
		     {
				$count=count($_SESSION['cart']);
		        $_SESSION['cart'][$count]=array('productID'=>$_POST['productID'],'price'=>$_POST['price'],'quantity'=>1);

			    ?>
		      <script type="module">              	 
                alert("added to cart");
				window.location.href="wishlist.php";
                 </script>
		        <?php
		     }
		
	    }
	    else
	    {
			
		  $_SESSION['cart'][0]=array('productID'=>$_POST['productID'],'price'=>$_POST['price'],'quantity'=>1);
		  
	      ?>
		     <script type="module">              	 
             alert("added to cart");
			 window.location.href="wishlist.php";
                 </script>
		<?php
		}
		
		
	}

?>

		   <div class="col-2">
			  
                    <div class="textbox">
                    <p> <?=$row["description"] ?></p>
                    </div>
                     <h4>Rs. <?=$row["price"] ?></h4>
		 
			
			   <a href=""><button type="submit" name="addtocart" class="cart-btn" >Add to Wishlist</button></a>
			   <a href="<?=$row["link"] ?>"><button type="button" name="link" class="cart-btn" >Visit</button></a>
			   <input type="hidden" name="productID" value="<?=$row['productID']?>">
			   <input type="hidden" name="price" value="<?=$row['price']?>">
			  </form>
			   
			   
		     </div>
		</div>
		
	</div>
	

		      <?php   
			}
		
	?>
	
	
	<!-- footer begins -->
	
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
