<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DealCongNghe.Com</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- FontAwsome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <!-- Google Fonts -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto"
    />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
      body {
        font-family: "Roboto";
      }

      #left-sidebar,
      #main-content {
        height: 500px;
        border: 1px solid red;
        margin-bottom: 50px;
      }

      #footer {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#navbar-collapse"
            aria-expanded="false"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">DealCongNghe.Com</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Sản Phẩm</a></li>
			<li><a href="#">About Us</a></li>            
          </ul> -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="createpost.html">Đăng Tin</a></li>
            <!-- <li><a href="#">Đăng Ký</a></li> -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="managepost.html">Quản Lý Tin Đăng</a></li>
            <!-- <li><a href="#">Đăng Ký</a></li> -->
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </nav>

    <!-- Place your code at here! -->

    <?php

require_once('data_access_helper.php');

//Create an instance of data access helper
$db = new DataAccessHelper();

//Connect to database
$db->connect();


$product_name = "";
$price = "";
$category = "";
$image_link = "";
$product_link = "";

if (isset($_POST['product_name'])) {
  $product_name = $_POST['product_name'];
}
if (isset($_POST['price'])) {
  $price = $_POST['price'];
}
if (isset($_POST['category'])) {
  $category = $_POST['category'];
}
if (isset($_POST['image_link'])) {
  $image_link = $_POST['image_link'];
}
if (isset($_POST['product_link'])) {
  $product_link = $_POST['product_link'];
}

// echo $product_name;
// echo $price;
// echo $category;
// echo $image_link;
// die();

$result = $db->executeQuery("INSERT INTO Product (ProductName, RegularPrice, SalePrice, CategoryName, ImageLink, ProductLink)
VALUES ('$product_name',  '$price', '$price', '$category', '$image_link', '$product_link');");

echo "<div class='alert alert-success'>Tạo thành công tin mới</div>"
?>

    <div id="main">
      <div class="container">
        <div id="alert"></div>
        <h2>Đăng tin miễn phí</h2>
        <br />
        <form action="createpost.php" method="POST">
          <div class="form-group">
            <label for="txtProductName">Tên sản phẩm</label>
            <input
              name="product_name"
              type="text"
              class="form-control"
              id="txtProductName"
              placeholder="Iphone 6 like new 99%"
            />
          </div>
          <div class="form-group">
            <label for="txtPrice">Giá bán</label>
            <input
              type="text"
              name="price"
              class="form-control"
              id="txtPrice"
              placeholder="8000000"
            />
          </div>
          <div class="form-group">
            <label for="txtCategory">Loại</label>
            <input
              type="text"
              name="category"
              class="form-control"
              id="txtCategory"
              placeholder="Camera,Phone,..."
            />
          </div>
          <div class="form-group">
            <label for="txtImageLink">Link hình ảnh</label>
            <input
              type="text"
              name="image_link"
              class="form-control"
              id="txtImageLink"
              placeholder="http://static.lazada.vn/p/image-33784-1-product.jpg"
            />
          </div>
          <div class="form-group">
            <label for="txtImageLink">Link sản phẩm</label>
            <input
              type="text"
              name="product_link"
              class="form-control"
              id="txtProductLink"
              placeholder="http://lazada.vn/product/iphone-8.html"
            />
          </div>
          <div class="input-group-btn">
            <button class="btn btn-danger" type="submit">
              Đăng tin
            </button>
          </div>
        </form>
        <br />
      </div>
    </div>

    <!-- Footer -->
    <div id="footer">
      <div class="container">
        <p>All rights reserved by DealCongNghe.Com</p>
      </div>
    </div>

    <!-- DO NOT REMOVE THE 2 LINES -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/ajaxex.js"></script>
  </body>
</html>
