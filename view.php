<?php
session_start();
if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = substr(md5(mt_rand()), 0, 6);
}
include 'connection/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web Ordering System</title>
  <link rel='stylesheet' href='css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container">
        <h1 class="text-center">Add to Cart</h1>
        <main class="grids">
            <?php
            $id = $_GET['id'];
            $table = $_GET['table'];
            $query = "SELECT * FROM menus WHERE product_id = '$id'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);
            ?>
            <article>
                <div class="text text-center">
                    <h1><?php echo $row['product_name']; ?></h1>
                    <h3>Price: Php <?php echo number_format($row['price'], 2); ?></h3>
                    <form method="POST">
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="10" value="1">

                            <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                            <input type="hidden" name="id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="order_no" value="<?php echo $_SESSION['order']; ?>">
                            <input type="hidden" name="table_no" value="<?php echo $_GET['table']; ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" name="addtocart" value="Add to Cart">
                        <a href="menu.php?table=<?php echo $table; ?>" class="btn btn-primary">Back</a>
                    </form>
                </div>
            </article>
        </main>
    </div>
    <!-- partial -->


    <?php
    if (isset($_POST['addtocart'])) {
        $quantity = $_POST['quantity'];
        $id = $_POST['id'];
        $table_no = $_POST['table_no'];
        $order_no = $_POST['order_no'];
        $price = $_POST['price'];
        $select = "SELECT * FROM cart WHERE order_no = '$order_no' AND product_id = '$id'";
        if(mysqli_num_rows(mysqli_query($con, $select)) > 0){

            $update = mysqli_query($con, "UPDATE cart SET quantity = quantity + '$quantity' WHERE order_no = '$order_no' AND product_id = '$id'");
            if ($update) {
                echo "<script>alert('Cart Updated')</script>";
                echo "<script>window.location.href='menu.php?table=$table_no'</script>";
            } else {
                echo "<script>alert('Failed to update cart')</script>";
                echo "<script>window.location.href='menu.php?table=$table_no'</script>";
            }
            
        } else {

        $query = "INSERT INTO cart (order_no, product_id, quantity, price, date_added, TransactionType) VALUES ('$order_no', '$id', '$quantity', '$price', NOW(), 'Restaurant')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<script>alert('Added to cart')</script>";
            echo "<script>window.location.href='menu.php?table=$table_no'</script>";
        } else {
            echo "<script>alert('Failed to add to cart')</script>";
            echo "<script>window.location.href='menu.php?table=$table_no'</script>";
        }
    }
}
    ?>
</body>

</html>