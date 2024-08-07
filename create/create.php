<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


// try {
//     $stmt = $pdo->prepare("INSERT INTO todos(title) VALUE(?)");
//         $res = $stmt->execute([$title]);
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }


if(isset($_POST['title'])){
    require '../config.php';

    $title = $_POST['title'];

    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res){
            header("Location: ../index.php?mess=success"); 
        }else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}
