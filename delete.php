<?php 
include 'connection/config.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $table = $_GET['table'];
    $delete = "DELETE FROM cart WHERE cart_id = '$id'";
    $result = mysqli_query($con, $delete);
    if($result){
        echo "<script>alert('Deleted from cart')</script>";
        echo "<script>window.location.href='menu.php?table=$table'</script>";
    } else {
        echo "<script>alert('Failed to delete from cart')</script>";
        echo "<script>window.location.href='menu.php?table=$table'</script>";
    }
}
?>