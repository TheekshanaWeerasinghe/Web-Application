<?php
session_start();
include_once "DBController.php";
?>
<html>
    <head>
        <title>login page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Owl-carousel CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <!-- font awesome icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Custom CSS file -->
        <link rel="stylesheet" href="login_style.css">
        <style>
          body {
            margin: 0;
            padding: 0;
            /*background: #1f1f38;*/
            background: #000;
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: cover;
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
      </div>


          <div class="login-box">
            <h2>LOGIN</h2>
            <form  name="login" id="login" method="post" action="login.php" onSubmit="return vallogin(this)"
         >
              <div class="user-box">
                <input type="text" name="txtuname" id="txtuname" required="" >
                   <label>Username*</label>
                
              </div>
              <div class="user-box">
                <input type="password" name="txtpassword" id="txtpassword" required="" >
                    <label>Password*</label>
              </div>
                          <p>
                <?php
                
                    if(isset($_POST["btnsubmit"]))
                    {
                      $username = $_POST["txtuname"];
                      $password = $_POST["txtpassword"];
                      $valid = false;
                      
                      $con = mysqli_connect("localhost","root","","Manga");
                      
                      if(!$con)
                      {
                        die("cannot connect to db server");
                      }
                      
                      
                      
                      $sql = "SELECT * FROM `users` WHERE `email`= '".$username."' and `password` = '".$password."';";
                      
                      $result = mysqli_query($con,$sql);
                      
                      
                  
                    if( mysqli_num_rows($result)>0)
                    {
                
                      $valid = true;
                      }
                      else 
                      {
                        ?>
                
                          <script type="module">
                          swal.fire("ERROR!", "User doesnt exist");
                      </script>
                    
                              <?php
                        
                        $valid = false;
                      }
                       
                      if ($valid)
                      {					
                
                        $_SESSION["username"] = $username;
                        header("Location: home.html");	  
                        
                      }
                      else 
                      {
                       ?>
                        <script type="module">
                            swal.fire("ERROR!", "User doesnt exist");
                          event.preventDefault();
                            </script>
                       <?
                      }
                    }			  
                ?>
                </p>
                
              <button class="bn" name="btnsubmit" onClick="return vallogin();" >
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Login
                </button>
            
            </form>
          </div>


          <div class="login-boxx">
            <h2>Register</h2>
            <form  action="" method="post" id="reg" onSubmit="return valreg(this)">
                 <div class="user-boxx">
                <input type="text" name="txtname" id="txtname" required="" >
                          <label>Fullname*</label>
              
              </div>
              <div class="user-boxx">
                <input type="text" name="txtemail" id="txtemail" required="" >
                          <label>Email Address*</label>         
              </div>
                    
              <div class="user-boxx">
                <input type="password" name="rpassword" id="txtpasswordr" required="" >
                  <label>Password</label>
                </div>
                <div class="user-boxx">
                <input type="password" name="cpassword" id="txtCpassword" required="" >
                  <label> Confirm Password</label>
                </div>
                <div>
                    <input type="checkbox" name="checkbok" id="chkbox"> I agree to the terms and conditions.
                </div>
<p>
                   <?php
              
                  if(isset($_POST["btnreg"]))
                  {
                     $name = $_POST["txtname"];
                     $email = $_POST["txtemail"];
                     $rpassword = $_POST["rpassword"];
                     $valid = false;
                    
                
                    
                    $con = mysqli_connect("localhost","root","","Manga");
                    $sql = "INSERT INTO `users`(`FullName`, `email`, `password`) VALUES ('".$name."','".$email."','".$rpassword."')";
                    
                    if(!$con)
                    {
                      die("cannot connect to db server");
                    }
                    
                    $check_duplicate_username = "SELECT `email` FROM users WHERE email = '".$email."' ";
                    
                    $answer = mysqli_query($con, $check_duplicate_username);
                    
                    $count = mysqli_num_rows($answer);
                    
                    if($count>0)
                    {
                    
                    ?>
                        <script type="module">
                      swal.fire("ERROR!", "User already exists");
                      Event.preventDefault();
                            </script>
                            <?php
                      return false;
                    }
                    
                    else
                    {
                      
                        $result = mysqli_query($con,$sql);
                        ?>
                              <script type="module">
                                console.log("cfc");
                              swal.fire("!", "User registered");
                              </script>
                              <?php
                    }
                    
                  }			  
              ?>
            </p>    
              <button class="bnn"  name="btnreg" onClick="return valreg();">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Register
             </button>
            </form>
          </div>



  <script>
    function valusername()
	{
		var mail= document.getElementById("txtuname").value;
	if ((mail != "")&&(mail.includes("@gmail.com"))||(mail.includes("@yahoo.com"))||(mail.includes("@icloud.com")))
			{
				return true;
			}
		else{
				
			return false;
		}
		
	}
	
	function valpassword()
	{
		var password=document.getElementById("txtpassword").value;
		if (password =="")
			{
				
				return false;
			
			}
		else{
			return true;
		}
	}
	
	function vallogin()
	{
		if ( valusername() && valpassword())
			{
				return true;
			}
		else 
			{	
				event.preventDefault();
				swal.fire("ERROR", "Check username and Password");
				return false;
			}
	}
	
	function fullname()
	{
		 var fullname = document.getElementById("txtname").value;
		if(fullname != "")
			{
				return true;
			}
		else{
      event.preventDefault();
			swal.fire("Enter FullName");
			return false;
		}
	}
		
	
	function valemail()
	{
		var mail = document.getElementById("txtemail").value;
		if ((mail != "")&&(mail.includes("@gmail.com"))||(mail.includes("@yahoo.com"))||(mail.includes("@icloud.com")))
			{   
				return true;
			}
		else 
			{
        event.preventDefault();
				swal.fire("Enter a valid email");
				return false;
			}
	}
	
	function valpasswordr()
	{
		var passr = document.getElementById("txtpasswordr").value;
		if(passr == "")
			{
        event.preventDefault();
				return false;
			}
		else 
			{
				return true;
			}
	}
	
	function valcpass()
	{
		var cpass = document.getElementById("txtCpassword").value;
		var passr = document.getElementById("txtpasswordr").value;
		
		if(cpass == passr)
			{
				return true;
			}
		else
			{
        event.preventDefault();
				swal.fire("Enter matching password");
				return false;
			}
	}
	
	function valagreement()
	{
		var check = document.getElementById("chkbox").checked;
		if(check == true)
			{
				return true;
			}
		else
			{
        event.preventDefault();
				Swal.fire({
				    title: 'Oops...',
					text: 'Agree to Terms and Conditions.',
					footer: '<a href="tc.php">Terms and Conditions.</a>'
				          })
				    return false;
			}
	}
	
	function valreg()
	{ 
		if((fullname()) && (valemail()) && (valpasswordr()) && (valcpass()) && (valagreement()))
			{
				return true;
			}
		else{
			event.preventDefault();
	return false;
		}
	}
	
 </script>
	



    </body>
</html>