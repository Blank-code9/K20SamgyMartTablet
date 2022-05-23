<?php 
session_start();
include 'connection/config.php';

if(isset($_GET['order'])){
    $order = $_GET['order'];
    $table = $_GET['table'];
    unset($_SESSION['order']);
    if(empty($_SESSION['order'])){
        $_SESSION['order'] = $order;
        echo "<script>window.location.href='menu.php?table=$table'</script>";
    } else {
        echo "<script>alert('Failed to reorder')</script>";
        echo "<script>window.location.href='orders.php?order=$order'</script>";
    }
    
}
?>