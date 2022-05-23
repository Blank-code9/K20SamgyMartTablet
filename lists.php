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
        <h1 class="text-center">List of Orders</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Table No</th>
                        <th>Customer Name</th>
                        <th>Order Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM orders";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $table_num = $row['table_no'];
                        $vacant = mysqli_query($con, "SELECT * FROM orders ORDER by order_id DESC");
                        $getOrder = mysqli_fetch_array($vacant);
                    ?>
                        <tr>
                            <td><?php echo $row['order_no']; ?></td>
                            <td><?php echo $row['table_no']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['order_added']; ?></td>
                            <td><?php
                                if ($row['status'] == 0) {
                                    echo "<span class='text-danger'>Occupied</span>";
                                } else {
                                    echo "<span class='text-success'>Available</span>";
                                }
                                ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-right">
                <a href="index.php" class="btn btn-primary">Back to Tables</a>
            </div>
        </div>
        <!-- partial -->


</body>

</html>