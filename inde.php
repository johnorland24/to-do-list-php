<?php 
if (!empty($_SESSION['id'])){
$id = $_SESSION['id'];
$result = mysqli_query($sqli, "SELECT * FROM Log_in_Out WHERE id = $id");
$row = mysqli_fetch_assoc($result);
}
else{
    header("Location: login.php");
}

?>