<?php

$erros = "";

$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "todo_site";

//create connection
$con = new mysqli($servername, $username, $pwd, $dbname);

//check connection
// if (!$con){
//     die("Connection Failed: ". $con->connect_error);
// }

// echo "Connection Success";

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    if(empty($task)){
        $erros = "Please Fill the Task...";
    }
    else{
    //mysqli_query($con, "insert into tasks (Task) values ('$task')");
    $sql = "insert into tasks(Task) values ('$task')";
    header('location: index.php');
        if ($con->query($sql) === TRUE){
            echo "Added Success";
        }
        else{
            echo "Error : " .$sql . "<br>" .$con->error;
        } 
    }
}

    //delete tasks
    if (isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($con, "DELETE FROM tasks WHERE ID=$id");
        header("location: index.php");
    }

$getTasks = mysqli_query($con, "Select * from tasks");

$con -> close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="img/workshop-2Kqhw3qST0o-unsplash.ico" crossorigin>   
    <link rel="stylesheet" href="css/style.css">
    <title>To-do</title>
</head>
<body>
    <div class="header" role="banner">
        <h1>To - Do Things</h1>
    </div>

    <div class="main">
        <form action="index.php" method="POST">
            <div class="container" role="form">
                <input type="text" placeholder="Enter Items..." class="txtInput" name="task">
                <input type="submit" class="btnSubmit" name="submit" role="button">

                <?php
                    if(isset($erros)){?>
                        <p><?php echo $erros; ?></p>
                <?php   }
                ?>

            </div>
        </form>
        
        <table>
            <thead>
                <tr class="tableHeader">
                    <th>To Do</th>
                    <th>Action</th>
                </tr>
            </thead>
        
            <tbody>
            <?php
                while($row = mysqli_fetch_array($getTasks)){ ?>
                    <tr>
                        <td class=""><?php echo $row['Task'];?></td>
                        <td class="delete"><a href="index.php?del_task=<?php echo $row['ID']; ?>">Remove</a></td>
                    </tr>
                <?php }?>


            </tbody>
        </table>
    </div>
</body>
</html>