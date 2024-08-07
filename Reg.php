<?php 
require 'config2.php';
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $duplicate = mysqli_query($conn, "SELECT * FROM Log_in_Out WHERE username = '$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or email has already been taken');</script>";
    }
    else {
        if ($password == $confirm_password) {
            $query = "INSERT INTO Log_in_Out (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";
            mysqli_query($conn, $query);
            
        }
        else {
            $message = "Password and Confirm Password does not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="res.css">

    <style>
        .popup {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color:transparent;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        
        }
        .popup-message {
        margin-top: 20%;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        color: red
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
    <div class="container">
        <div class="card">
            <h2 class="card-header">To-Do List Awaits!</h2>
            <div class="card-body">
                <form action="" method="post" autocomplete="off" class="form-horizontal">
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">User:</label>
                        <div class="col-sm-9">
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="confirm_password" class="col-sm-3 col-form-label">Confirm :</label>
                        <div class="col-sm-9">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="offset-sm-3 col-sm-9">
                            <input name="submit" type="submit" value="Register" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                <p>You remember huh? <a href="login.php">Login</a></p>
            </div>
        </div>
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
