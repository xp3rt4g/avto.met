<?php
session_start();
if(isset($_SESSION['user_type'])){
if($_SESSION['user_type'] == 'Admin'){

    if(isset($_POST['name'])){

        include_once 'connect.php';

        $name = $_POST['name'];

        $query = "INSERT INTO colors (name) VALUES (?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$name]);

        header("Location: editColors.php");
    }
    else{
        header("Location: editColors.php");
    }

}
else{
    header("Location: index.php");
}
}
else{
    header("Location: index.php");
}

?>