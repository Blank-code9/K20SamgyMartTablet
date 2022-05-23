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
        <div class="search">
            <form method="GET" action="search.php">
                <div class="form-group d-flex">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                    <input type="hidden" class="form-control" id="table" name="table" value="<?php echo $_GET['table']; ?>">
                <button type="submit" class="btn btn-primary" name="search_btn">Search</button>
                </div>
            </form>

        </div>
        <h1 class="text-center">Table <?php echo $_GET['table']; ?></h1>
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Snacks')" id="defaultOpen">Unli Foods</button>
            <button class="tablinks" onclick="openCity(event, 'Main Course')">Silog Meals</button>
            <button class="tablinks" onclick="openCity(event, 'Drink')">Bento Box</button>
            <button class="tablinks" onclick="openCity(event, 'Dessert')">Drinks</button>
            <button class="tablinks" onclick="openCity(event, 'Others')">Others</button>
            <button class="tablinks"><a href="index.php" style="color: black;border-bottom: solid 1px black;"><i class="fa fa-back"></i>Back</a></button>
        </div>

        <div id="Snacks" class="tabcontent">
            <div class="table-responsive">
                <table class="table">
                    <?php
                    $get = "SELECT * FROM menus WHERE category = 'Unli' AND status ='1'";
                    $result = mysqli_query($con, $get);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td style='width: 10%'>
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
                </table>
            </div>
        </div>

        <div id="Main Course" class="tabcontent">
            <div class="table-responsive">
                <table class="table">
                    <?php
                    $get = "SELECT * FROM menus WHERE category = 'Silog Meals' AND status ='1'";
                    $result = mysqli_query($con, $get);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td style='width: 10%'>
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
                </table>
            </div>
        </div>

        <div id="Drink" class="tabcontent">
            <div class="table-responsive">
                <table class="table">
                    <?php
                    $get = "SELECT * FROM menus WHERE category = 'Bento Box ' AND status ='1'";
                    $result = mysqli_query($con, $get);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td style='width: 10%'>
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
                </table>
            </div>
        </div>

        <div id="Dessert" class="tabcontent">
            <div class="table-responsive">
                <table class="table">
                    <?php
                    $get = "SELECT * FROM menus WHERE category = 'Drinks' AND status ='1'";
                    $result = mysqli_query($con, $get);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td style='width: 10%'>
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
                </table>
            </div>
        </div>
        <div id="Others" class="tabcontent">
            <div class="table-responsive">
                <table class="table">
                    <?php
                    $get = "SELECT * FROM menus WHERE category = 'Others' AND status ='1'";
                    $result = mysqli_query($con, $get);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td style='width: 10%'>
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
                </table>
            </div>
        </div>
        <div class="container">
            <div class="row">
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
                            <?php 
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                            <tfoot>
                                <tr>
                                    <th colspan="4"></th>
                                    <th colspan="1">
                                        <a class="btn btn-primary" href="checkout.php?table=<?php echo $_GET['table']; ?>">
                                            Checkout
                                        </a>

                                    </th>
                                </tr>

                            </tfoot>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>


            </div>
        </div>
        <!-- partial -->

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

        <script>
            function incrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                if (!isNaN(currentVal)) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(0);
                }
            }

            function decrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                if (!isNaN(currentVal) && currentVal > 0) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(0);
                }
            }

            $('.input-group').on('click', '.button-plus', function(e) {
                incrementValue(e);
            });

            $('.input-group').on('click', '.button-minus', function(e) {
                decrementValue(e);
            });

            $(document).ready(function() {
                $('body').on('click', '.addSnacks', function() {
                    document.getElementById("product_id").value = $(this).attr('data-id');
                    console.log($(this).attr('data-id'));
                });


                $("#addSnacks").on("hidden.bs.modal", function() {
                    $('.append_items').remove();
                });
            });
        </script>
</body>

</html>