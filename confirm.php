<?php 
include 'connection/config.php';

if(isset($_GET['order'])){
    $order = $_GET['order'];
    $table = $_GET['table'];
    $ordernumber = $_GET['orderno'];
    $date = date("Y-m-d");
 
    $select = mysqli_query($con, "SELECT * FROM orders WHERE table_no ='$table'");
    $roww = mysqli_fetch_array($select);
    $total = $roww['order_total'];
    
    $update = mysqli_query($con, "UPDATE orders SET status = '1', order_no ='', customer_name = '', order_added = '' WHERE table_no = '$table'");
    $inserttotal = mysqli_query($con, "INSERT INTO `sales`(`order_id`, `total`, `date`) VALUES ('$ordernumber','$total','$date')");
    if($update && $inserttotal){
        echo "<script>alert('".$ordernumber."')</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Failed to update order')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
    
    
}
?>


