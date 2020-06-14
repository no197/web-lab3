<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DealCongNghe.Com</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <!-- FontAwsome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
      body {
        font-family: 'Roboto';
      }

      #left-sidebar, #main-content {
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
          <button type="button" class="navbar-toggle collapsed"
            data-toggle="collapse" data-target="#navbar-collapse"
            aria-expanded="false">
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
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>


    <!-- Place your code at here! -->
    <div id="main">	
        
    <?php  
    require_once('data_access_helper.php');

    //Create an instance of data access helper
    $db = new DataAccessHelper();

    //Connect to database
    $db->connect();
    $id= 1;
    $product_name = "";
    $price = "";
    $category = "";
    $image_link = "";
    $product_link = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

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
    $result = $db->executeQuery("UPDATE Product 
    set ProductName = '$product_name', RegularPrice = '$price', SalePrice = '$price',
     CategoryName = '$category', ImageLink = '$image_link', ProductLink ='$product_link'
     WHERE id = $id;");

    echo "<div class='alert alert-success'>Sửa tin thành công</div>";
        
    }
   
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }
    
	
    $product_name = "";
    $price = "";
    $category = "";
    $image_link = "";
    $product_link = "";

    $result = $db->executeQuery("SELECT * FROM Product WHERE id=$id;");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
            $product_name=$row["ProductName"];
            $price = $row["RegularPrice"];
            $category = $row["CategoryName"];
            $image_link = $row["ImageLink"];
            $product_link = $row["ProductLink"];
        }
    }
?>
      <div class="container">
		<h2>Chỉnh Sửa Tin</h2>
		<br/>
        <form action="editpost.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="form-group">
            <label for="txtProductName">Tên sản phẩm</label>
            <input
              name="product_name"
              type="text"
              class="form-control"
              id="txtProductName"
              placeholder="Iphone 6 like new 99%"
              value="<?php echo $product_name; ?>"
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
              value="<?php echo $price; ?>"
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
              value="<?php echo $category; ?>"
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
              value="<?php echo $image_link; ?>"
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
              value="<?php echo $product_link; ?>"
            />
          </div>
          <div class="input-group-btn">
            <button class="btn btn-danger" type="submit">
              Sửa tin
            </button>
          </div>
        </form>
		<br/>        
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
  </body>
</html>