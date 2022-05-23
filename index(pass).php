<?php 
session_start();
include 'config.php';
if(!isset($_SESSION['order'])){
    $_SESSION['order'] = substr(md5(mt_rand()), 0, 6);
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Web Ordering System</title>
  <link rel='stylesheet' href='./bootstrap.min.css'>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <h1 class="text-center">Tables</h1>
  <main class="grid">
    <?php 
    $query = "SELECT * FROM tables";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)){
      $table_num = $row['table_no'];
      $vacant = mysqli_query($con, "SELECT * FROM orders WHERE table_no = '$table_num' AND status = '0'");
      $getOrder = mysqli_fetch_array($vacant);
    ?>
    <article>
        <?php 
        if(mysqli_num_rows($vacant) > 0){
        ?>
      <a href="orders.php?order=<?php echo $getOrder['order_no']; ?>">
      <?php } else {
        ?>
        
      <a href="menu.php?table=<?php echo $row['table_no']; ?>">
      <?php
      } ?>
      <div class="text text-center">
        <h1><?php echo $row['table_no']; ?></h1>
        <?php 
        if(mysqli_num_rows($vacant) > 0){
        ?>
        <p><?php echo $getOrder['customer_name']; ?></p>
        <?php } ?>
      </div>
      </a>
    </article>
    <?php } ?>
  </main>
</div>
<!-- partial -->
  
</body>
</html>
