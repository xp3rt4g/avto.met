<?php
session_start();
if(isset($_SESSION['user_type'])){
if($_SESSION['user_type'] == 'Admin'){

    if(isset($_POST['name']) && isset($_POST['manufacturer'])){

        include_once 'connect.php';

        $name = $_POST['name'];
        $manufacturer = $_POST['manufacturer'];

        $query = "INSERT INTO models (name, manufacturer_id) VALUES (?,?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $manufacturer]);

        header("Location: editModels.php");
    }
    else{
        header("Location: addModel.php");
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