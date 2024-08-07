<?php
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "to_do_list";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the to-do items from the database
    $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
} catch(PDOException $e) {
    // If there is an error connecting to the database, the catch block will be executed.
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>

