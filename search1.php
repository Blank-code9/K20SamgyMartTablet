<?php

include 'connection/config.php';

$sql = "SELECT * FROM menus WHERE product_name LIKE '%".$_POST['name']."%'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0){
	while ($row=mysqli_fetch_assoc($result)) {
		echo "	<tr>
		          <td>".$row['product_name']."</td>
		          <td>".$row['price']."</td>
		          
		        </tr>";
	}
}
else{
	echo "<tr><td>0 result's found</td></tr>";
}

?>