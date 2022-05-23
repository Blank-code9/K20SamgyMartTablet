<?php
session_start();
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
<?php
$order_no = $_GET['order'];
$data = mysqli_query($con, "SELECT * FROM orders WHERE order_no = '$order_no'");
$row = mysqli_fetch_array($data);

?>

<body>
    <!-- partial:index.partial.html -->
    <div class="container">
        <h1 class="text-center">View Order #<?php echo $row['order_no']; ?></h1>
        <h3 class="text-center">Table #<?php echo $row['table_no']; ?></h3>

        <form method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Personal Information</h1>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['customer_name']; ?>" placeholder="Enter name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Contact">Contact</label>
                            <input type="number" class="form-control" id="contact" name="contact" value="<?php echo $row['customer_contact']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <p>Payment: <b>
                                    <?php
                                    $data = mysqli_query($con, "SELECT * FROM orders WHERE order_no = '$order_no'");
                                    $row = mysqli_fetch_array($data);
                                    if ($row['payment'] == '0') {
                                        echo "<span class='text-danger'>Unpaid</span>";
                                    } else {
                                        echo "<span class='text-success'>Paid</span>";
                                    }
                                    ?>
                                </b>
                            </p>
                        </div>
                        <input type="hidden" name="order_no" value="<?php echo $_SESSION['order']; ?>">
                        <!-- <input type="hidden" name="table_no" value="<?php echo $_GET['table']; ?>"> -->


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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get = "SELECT * FROM cart WHERE order_no = '" . $row['order_no'] . "'";
                                    $result = mysqli_query($con, $get);
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
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">
                                            Grand total
                                        </th>
                                        <th colspan="1">

                                            <?php
                                            $total = mysqli_query($con, "SELECT SUM(price * quantity) AS total FROM cart WHERE order_no = '" . $_GET['order'] . "'");
                                            $row3 = mysqli_fetch_array($total);

                                            ?>
                                            <h3 class="text-bold">Php <?php echo number_format($row3['total'], 2); ?></h3>
                                        </th>
                                    </tr>

                                </tfoot>
                            </table>
                            <div class="form-group">
                                <a href="index.php" class="btn btn-primary">Back</a>

                                <?php
                                $data = mysqli_query($con, "SELECT * FROM orders WHERE order_no = '$order_no'");
                                $row = mysqli_fetch_array($data); ?>
                                <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" name="pay" class="btn btn-success">Pay</button> -->
                                <?php
                                $table = $row['table_no'];
                                
                                ?>
                                <a href="confirm.php?order=<?php echo $_GET['order']; ?>&table=<?php echo $table; ?>&orderno=<?php echo $order_no; ?>" class="btn btn-info">Confirm Order</a>
                                <a href="reorder.php?order=<?php echo $_GET['order']; ?>&table=<?php echo $table; ?>" class="btn btn-warning">Reorder</a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <?php
                                                $data = mysqli_query($con, "SELECT * FROM orders WHERE order_no = '$order_no'");
                                                $row = mysqli_fetch_array($data); ?>
                                                <div class="form-group">
                                                    <label for="payment">Payment</label>
                                                    <input type="number" class="form-control" value="<?php echo $row['order_total']; ?>" id="payment" name="payment" min="<?php echo $row['order_total']; ?>" placeholder="Enter payment">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="submit" name="pay" class="btn btn-primary" value="Submit Payment">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    if (isset($_POST['pay'])) {
        $payment = $_POST['payment'];
        $order_no = $_GET['order'];
        $update = mysqli_query($con, "UPDATE orders SET payment = '1' WHERE order_no = '$order_no'");
        if ($update) {
            echo "<script>alert('Payment Successful');</script>";
            echo "<script>window.location.href='orders.php?order=$order_no';</script>";
        } else {
            echo "<script>alert('Payment Failed');</script>";
        }
    }
    ?>
   
</body>

</html>