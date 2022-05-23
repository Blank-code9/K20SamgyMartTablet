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

<body>
    <!-- partial:index.partial.html -->
    <div class="container">
        <h1 class="text-center">Search results for <?php echo $_GET['search']; ?></h1>
        <h3 class="text-center">Table #<?php echo $_GET['table']; ?></h3>

        <form method="post">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $word = $_GET['search'];
                    $get = "SELECT * FROM menus WHERE status = '1' AND product_name LIKE '%$word%' OR category LIKE '%$word%'";
                    $result = mysqli_query($con, $get);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td>
                                <?php echo $row['product_name']; ?>
                            </td>
                            <td>
                                Php <?php echo number_format($row['price'], 2); ?>
                            </td>
                            <td>
                                <a class="btn btn-primary addSnacks" href="view.php?table=<?php echo $_GET['table']; ?>&id=<?php echo $row['product_id']; ?>">
                                    Add to Cart
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <a class="btn btn-primary" href="index.php">Back</a>
                            </td>
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
</body>

</html>