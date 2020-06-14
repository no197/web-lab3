

<?php

require_once('data_access_helper.php');

//Create an instance of data access helper
$db = new DataAccessHelper();

//Connect to database
$db->connect();


$link = 'http://localhost/lab3src/controllers/searchpost.php';
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
  $col_row = 1;
  while ($row = $result->fetch_assoc()) {
    if ($col_row % 3 === 0) {
      echo "<div class='row'>";
    }
    echo "<div class='col-md-4 col-sm-6 col-xs-12 card'>";
    echo "<img class='thumbnail img-responsive' src='" . $row["ImageLink"] . "' />";
    echo "<div class='d-flex flex-col'>";
    echo "<p class='product-name'>" . $row["ProductName"] . '</p>';
    echo "<div class='prices'>";
    echo "<span>" . $row["SalePrice"] . 'đ</span>';
    echo "<span style='text-decoration: line-through;'>" . $row["RegularPrice"] . 'đ </span>';
    echo  '</div>';
    echo '</div>';
    echo '</div>';
    if ($col_row % 3 === 0) {
      echo "</div>";
    }
    $col_row++;
  }
} else {
  echo "<p class='text-center'>0 results<p>";
}
?>
