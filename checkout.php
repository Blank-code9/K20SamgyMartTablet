<?php
session_start();
include 'connection/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web Ordering System</title>.
   
  <link rel='stylesheet' href='css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container">
        <h1 class="text-center">Checkout Order #<?php echo $_SESSION['order']; ?></h1>

        <form method="post">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Personal Information</h1>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="Contact">Contact</label>
                            <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter contact">
                        </div>
                        <input type="hidden" name="order_no" value="<?php echo $_SESSION['order']; ?>">
                        <input type="hidden" name="table_no" value="<?php echo $_GET['table']; ?>">


                </div>

                <div class="col-md-12">
                    <h1 class="text-center">Cart</h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $get = "SELECT * FROM cart WHERE order_no = '" . $_SESSION['order'] . "'";
                                $result = mysqli_query($con, $get);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $prod_id = $row['product_id'];
                                    $get = "SELECT * FROM menus WHERE product_id = '$prod_id'";
                                    $result2 = mysqli_query($con, $get);
                                    $row2 = mysqli_fetch_array($result2);

                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $row2['product_name']; ?>
                                        </td>
                                        <td>
                                            Php <?php echo number_format($row['price'], 2); ?>
                                        </td>

                                        <td>
                                            <?php echo $row['quantity']; ?>
                                        </td>
                                        <td>
                                            Php <?php echo number_format($row['price'] * $row['quantity'], 2); ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="delete.php?id=<?php echo $row['cart_id']; ?>&table=<?php echo $_GET['table']; ?>">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } } else {
                                    echo "<tr><td colspan='5' class='text-center'>No items in cart</td></tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4"></th>
                                    <th colspan="1">
                                        <?php 
                                        if (mysqli_num_rows($result) > 0) {
                                        ?>
                                        <input type="submit" class="btn btn-primary" name="checkout" value="Checkout">
                                        <?php } ?>
                    <a href="index.php" class="btn btn-primary">Back</a>    
                                        <?php 
                                    $total = mysqli_query($con, "SELECT SUM(price * quantity) AS total FROM cart WHERE order_no = '" . $_SESSION['order'] . "'");
                                    $row3 = mysqli_fetch_array($total);

                                    ?>
                                        <input type="hidden" name="total" value="<?php echo $row3['total']; ?>">
                                    </th>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


            </div>
        </form>
        </div>
        <!-- partial -->

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php 
        if(isset($_POST['checkout'])){
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $order_no = $_POST['order_no'];
            $table_no = $_POST['table_no'];
            $total = $_POST['total'];
            $select = "SELECT * FROM orders WHERE order_no = '$order_no'";
            $result = mysqli_query($con, $select);
            if(mysqli_num_rows($result) > 0){
                $update = "UPDATE orders SET customer_name = '$name', customer_contact = '$contact', order_total = '$total' WHERE order_no = '$order_no'";
                mysqli_query($con, $update);
                unset($_SESSION['order']);
                echo "<script>alert('ReOrder has been placed!');</script>";
                echo "<script>window.location.href='index.php';</script>";
            } else {
            $q = "UPDATE `orders` SET `order_no`='$order_no',`customer_name`='$name',`customer_contact`='$contact',`order_total`='$total',`payment`='0',`order_added`= NOW(),`status`='0' WHERE `table_no`='$table_no'";
            $add = mysqli_query($con, $q);
            if($add){
                echo "<script>alert('Order has been placed!');</script>";
                unset($_SESSION['order']);
                echo "<script>window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Order failed!');</script>";
            }
        }
    }



        ?>
</body>

</html>

<!-- Recode -->
<!-- "INSERT INTO orders (order_no, table_no, customer_name, customer_contact, order_total,payment, order_added,status) VALUES ('$order_no', '$table_no', '$name', '$contact', '$total','0', NOW(),'0')"; -->