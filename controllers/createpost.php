

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

$result = $db->executeQuery("INSERT INTO Product (ProductName, RegularPrice, SalePrice, CategoryName, ImageLink, ProductLink)
VALUES ('$product_name',  '$price', '$price', '$category', '$image_link', '$product_link');");

echo "<div class='alert alert-success'>Tạo thành công tin mới</div>"
?>
