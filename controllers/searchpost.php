<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>DealCongNghe.Com</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- FontAwsome -->
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

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

    #left-sidebar,
    #main-content {
      height: 500px;
      border: 1px solid red;
      margin-bottom: 50px;
    }

    #footer {
      text-align: center;
    }

    .d-flex {
      display: flex;
      align-items: center;
      margin: 0 30px;
    }

    .flex-col {
      flex-direction: column;
    }
  </style>
  <script>
    // <!-- Tao ra danh sach san pham -->
    var
      products = [
        "../images/1.jpg",
        "../images/2.jpg",
        "../images/3.jpg",
        "../images/4.jpg",
        "../images/5.jpg",
        "../images/6.jpg",
        "../images/7.jpg",
        "../images/8.jpg",
        "../images/9.jpg",
        "../images/10.jpg",
        "../images/11.jpg",
        "../images/12.jpg",
        "../images/13.jpg",
        "../images/14.jpg",
        "../images/15.jpg",
        "../images/16.jpg",
        "../images/17.jpg",
        "../images/18.jpg",
        "../images/19.jpg",
        "../images/20.jpg",
        "../images/21.jpg",
        "../images/22.jpg",
        "../images/23.jpg",
        "../images/24.jpg"
      ];
    // <!--END Tao ra danh sach san pham-- >

    // <!--Khi trang web dang duoc load thi se chay code ben duoi-- >
    // window.onload = function(e) {
    //   var result = "";
    //   for (var i = 0; i < products.length; i++) {
    //     result += "<img class='col-md-4 col-sm-6 col-xs-12 thumbnail img-responsive' src='" + products[i] + "'>";
    //   }
    //   document.getElementById("search-result").innerHTML = result;
    // };

    function timkiem() {
      var result = "";
      var keyword = document.getElementById("keyword").value;
      if (keyword == "phone") {
        result += "<img class='col-md-4 col-sm-6 col-xs-12 thumbnail img-responsive' src='" + products[0] + "'>";
        result += "<img class='col-md-4 col-sm-6 col-xs-12 thumbnail img-responsive' src='" + products[1] + "'>";
      }
      document.getElementById("search-result").innerHTML = result;
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
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
    <div class="container">
      <form action="searchpost.php" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm..." name="keyword" id="keyword" />
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </form>
      <br />
      <!-- Grid system -->
      <div id="search-result" class="row">

        <?php

        require_once('data_access_helper.php');

        //Create an instance of data access helper
        $db = new DataAccessHelper();

        //Connect to database
        $db->connect();


        //  = 'http://localhost/lab3src/controllers/searchpost.php';
        // Get page number from url
        $keyword = "";
        if (isset($_GET['keyword'])) {
          $keyword = $_GET['keyword'];
        }

        // Get page number from url
        if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
        } else {
          $pageno = 1;
        }

        // Số sản phẩm trên một trang
        $no_of_records_per_page = 12;


        // Bỏ qua các trang trước 
        // 1 1-12
        // 2 13-24
        // 3 25-36

        $offset = ($pageno - 1) * $no_of_records_per_page;

        if ($keyword == "") {
          $where_condition = "";
        } else {
          $where_condition = " WHERE ProductName LIKE '%$keyword%' ";
        }

        // Câu truy vấn đếm tất cả sản phẩm để xem có bao nhiêu trang
        $total_pages_sql = "SELECT COUNT(*) FROM Product $where_condition";

        // // Run câu truy vấn
        $result = mysqli_query($conn, $total_pages_sql);
        $row = mysqli_fetch_row($result);
        $total_rows = (int) $row[0];

        // 110 sản phẩm -> 1 trang 12 sản phẩm ==> có bao nhiêu trang 
        // 9,...  ==> 

        // Đếm số trang
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        // //Query database

        // echo "SELECT * FROM Product" . $where_condition . "LIMIT $offset, $no_of_records_per_page;";
        $result = $db->executeQuery("SELECT * FROM Product" . $where_condition . " LIMIT " . $offset . ", " . $no_of_records_per_page . ";");

        //Display result out
        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-4 col-sm-6 col-xs-12 text-center'>";
            echo "<img class='thumbnail img-responsive' src='" . $row["ImageLink"] . "' />";
            echo "<div class='d-flex flex-col'>";
            echo '<p>' . $row["ProductName"] . '</p>';
            echo "<div class='d-flex' style='justify-content: space-around; align-self: normal;'>";
            echo '<span>' . $row["SalePrice"] . 'đ</span>';
            echo "<span style='text-decoration: line-through;'>" . $row["RegularPrice"] . 'đ </span>';
            echo  '</div>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo "<p class='text-center'>0 results<p>";
        }
        ?>

      </div>
      <div class="col-md-offset-5 col-4">
        <ul class="pagination mt-5">
          <li><a href="<?php echo "?keyword=$keyword&pageno=1" ?>">Page 1</a></li>
          <li class="<?php if ($pageno <= 1) {
                        echo 'disabled';
                      } ?>">
            <a href="<?php if ($pageno <= 1) {
                        echo '#';
                      } else {
                        echo "?keyword=$keyword&pageno=" . ($pageno - 1);
                      } ?>">Prev</a>
          </li>
          <li class="<?php if ($pageno >= $total_pages) {
                        echo 'disabled';
                      } ?>">
            <a href="<?php if ($pageno >= $total_pages) {
                        echo '#';
                      } else {
                        echo "?keyword=$keyword&pageno=" . ($pageno + 1);
                      } ?>">Next</a>
          </li>
          <li>
            <a href="<?php echo "?keyword=$keyword&pageno=$total_pages" ?>">
              <?php echo "Page " . $total_pages ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </div>

  <!-- Footer -->
  <div id="footer">
    <div class="container">
      <p>All rights reserved by DealCongNghe.Com</p>
    </div>
  </div>

  <!-- DO NOT REMOVE THE 2 LINES -->
  <!-- jQuery (necessary for Bootstrap' s JavaScript plugins) -->
  <script src="../js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../js/bootstrap.min.js"></script>
</body>

</html>