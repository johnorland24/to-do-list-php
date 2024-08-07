<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do list</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-container {
    background: white;
    padding: 2em;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 40px;
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
            width: 100px;
           
            
        }

        .btn:hover {
            background-color: #4cae4c;
        }
.todo-item small {
    display: block;
    width: 100%;
    padding: 5px 0px;
    color: #888;
    padding-left: 30px;
    font-size: 14px;
    font-family: sans-serif;
    margin-top: 5px;
  }
  
  .remove-to-do{
    display: block;
    float: right;
    width: 20px;
    height: 10px;
    font-family: sans-serif;
    color: #888;
    text-decoration: none;
    text-align: right;
    padding: 0px 5px 8px 0px;
    transition: background 1s;
    cursor: pointer;
  }
  
  .remove-to-do:hover {
    background: red;
    color: #fff;
  }
  
  .checked {
    color: #999 !important;
    text-decoration: line-through;
  }
  
  .todo-item input {
    margin: 0px 5px;
  }
  
  .empty {
    font-family: sans-serif;
    font-size: 16px;
    text-align: center;
    color: #cccc;
  }




    </style>
</head>
<body>
<div class="login-container">
        <h2 class="brand-title">The Procrastinator's Paradise - To-Do List App</h2>
        <form action="Reg.php" method="post">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>


    <div class="main-section">
        <div class="add-section">
            <form action="create/create.php" method="POST" autocomplete="off">
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'): ?>
                    <input type="text"
                     name="title"
                     style="border-color:#ff6666"
                     placeholder="Enter your todo, it's required"/>
                    <button type="submit">Add &nbsp;<span>&#43;</span></button>
                <?php else: ?>
                    <input type="text" 
                     name="title" 
                     placeholder="What do you want to list"/>
                    <button type="submit">Add &nbsp;<span>&#43;</span></button>
                   
                <?php endif; ?>
            </form>
        </div>

        <div class="show-todo-section">
        <?php if($todos->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/notes.svg" width="100%" />
                        <img src="img/spinner.gif" width="100%" height="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time'] ?></small> 
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("App/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('App/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>