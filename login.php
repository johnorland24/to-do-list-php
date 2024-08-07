<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'config2.php';

$message = ""; 

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM Log_in_Out WHERE username = '$username' OR email = '$username'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        }
        else{
            $message = "<h3> Hi. there soryy Wrong Password </h3>";
        }
    }
    else{
        $message = "Hi. there your not registered";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <style>
        body {  
    font-family: 'Arial', sans-serif;  
    background-color: #f4f4f4;  
    display: flex;  
    justify-content: center;  
    align-items: center;  
    height: 100vh;  
    margin: 0;  
}  

.login-container {  
    background: white;  
    padding: 2em;  
    border-radius: 5px;  
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  
    text-align: center;  
}  

.brand-title {  
    font-size: 2em;  
    margin-bottom: 1em;  
    color: #333;  
}  

.form-group {  
    margin-bottom: 1.5em;  
}  

label {  
    display: block;  
    margin-bottom: 0.5em;  
    color: #666;  
}  

input[type="text"],  
input[type="password"] {  
    width: 100%;  
    padding: 0.5em;  
    border: 1px solid #ddd;  
    border-radius: 5px;  
}  

.btn {  
    background-color: #5cb85c;  
    color: white;  
    padding: 0.7em;  
    border: none;  
    border-radius: 5px;  
    cursor: pointer;  
    width: 100%;  
}  

.btn:hover {  
    background-color: #4cae4c;  
}  

.register-link {  
    margin-top: 1em;  
    color: #888;  
}  

.register-link a {  
    color: #5cb85c;  
    text-decoration: none;  
}
        .popup {
            width: 300px;
            height: 100px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }

        .popup-message {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .popup-close {
            display: block;
            text-align: center;
            font-size: 16px;
            color: green;
            text-decoration: none;
            cursor: pointer;
        }
    
        
    </style>
</head>
<body>
<div class="login-container">  
        <h1 class="brand-title">log in</h1>  
        <form action="login.php" class="login-form" method="post" autocomplete="off">  
            <div class="form-group">  
                <label for="username">Username</label>  
                <input type="text" id="username" name="username" required>  
            </div>  
            <div class="form-group">  
                <label for="password">Password</label>  
                <input type="password" id="password" name="password" required>  
            </div>  
            <button name="submit" type="submit" class="btn" value="log in">Login</button>  
            <p class="register-link">Don't have an account? <a href="Reg.php">Register here</a></p>  
        </form>  
    </div>  
    <?php if(!empty($message)): ?>
        <div class="popup">
            <p class="popup-message"><?php echo $message; ?></p>
            <a class="popup-close" onclick="closePopup()">Close</a>
        </div>
        <script>
            function closePopup() {
                document.querySelector('.popup').style.display = 'none';
            }
        </script>
    <?php endif; ?>
</body>
</html>

