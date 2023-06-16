<?php
include_once "DBController.php";
?>
<html>
    <head>
        <title>Product page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Owl-carousel CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
        <!-- font awesome icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

        <!-- Custom CSS file -->
        <link rel="stylesheet" href="style1.css">
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


        <h1>Products</h1>


<div class="cardgroup" >

			
   <?php
      
      $con = mysqli_connect("localhost","root","","Manga");
                      
      if(!$con)
      {
        die("cannot connect to db server");
      }

      $sql="SELECT * from product";
      $result=$con-> query($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>

			<div class="card">
      <a href="viewdesign.php?id=<?php echo $row["productID"]; ?>" >
			<img src='<? echo $row["Image"]?>' style="width:100%">
      </a>
        </div>
		<?php
		}
	  }
    
		?> 	
	  <div class="pagination">
          <li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
          <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
          <li class="page-item dots"><a class="page-link" href="#">...</a></li>
          <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
          <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
          <li class="page-item dots"><a class="page-link" href="#">...</a></li>
          <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
          <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>
        </div>

	</div>

    <div class="footer">
        <div class="foot">
        <h3>Information</h3>
        <a href="home.html"><li>Home</li></a>
        <a href="contact.html"><li>About us</li></a>
        <a href="contact.html"><li>Contact us</li></a>
        </div>
    </div>


    <script>
        function getPageList(totalPages, page, maxLength){
          function range(start, end){
            return Array.from(Array(end - start + 1), (_, i) => i + start);
          }

          var sideWidth = maxLength < 9 ? 1 : 2;
          var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
          var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

          if(totalPages <= maxLength){
            return range(1, totalPages);
          }

          if(page <= maxLength - sideWidth - 1 - rightWidth){
            return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
          }

          if(page >= totalPages - sideWidth - 1 - rightWidth){
            return range(1, sideWidth).concat(0, range(totalPages- sideWidth - 1 - rightWidth - leftWidth, totalPages));
          }

          return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
        }

        $(function(){
          var numberOfItems = $(".cardgroup .card").length;
          var limitPerPage = 8; //How many card items visible per a page
          var totalPages = Math.ceil(numberOfItems / limitPerPage);
          var paginationSize = 7; //How many page elements visible in the pagination
          var currentPage;

          function showPage(whichPage){
            if(whichPage < 1 || whichPage > totalPages) return false;

            currentPage = whichPage;

            $(".cardgroup .card").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();

            $(".pagination li").slice(1, -1).remove();

            getPageList(totalPages, currentPage, paginationSize).forEach(item => {
              $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots")
              .toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
              .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
            });

            $(".previous-page").toggleClass("disable", currentPage === 1);
            $(".next-page").toggleClass("disable", currentPage === totalPages);
            return true;
          }

          $(".pagination").append(
            $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Prev")),
            $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Next"))
          );

          $(".cardgroup").show();
          showPage(1);

          $(document).on("click", ".pagination li.current-page:not(.active)", function(){
            return showPage(+$(this).text());
          });

          $(".next-page").on("click", function(){
            return showPage(currentPage + 1);
          });

          $(".previous-page").on("click", function(){
            return showPage(currentPage - 1);
          });
        });

	</script>
	


        
    </body>
</html>