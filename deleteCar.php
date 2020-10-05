<?php

session_start();
include 'connect.php';

if(isset($_GET['id']) && isset($_SESSION['user_id'])){
    $idCar = $_GET['id'];
    $query = "SELECT * FROM cars WHERE id=?";
    $stmt = $pdo->prepare($query);

    $stmt->execute([$idCar]);

    $row = $stmt->fetch();

    if($row['user_id'] == $_SESSION['user_id'] || $_SESSION['user_type'] == 'Admin'){
        $query = "SELECT * FROM images WHERE car_id=?";
        $stmt = $pdo->prepare($query);

        $stmt->execute([$idCar]);

        $row = $stmt->fetch();

        $url = $row['url'];

        unlink($url);

        $query = "DELETE FROM images WHERE car_id=?";
        $stmt = $pdo->prepare($query);

        $stmt->execute([$idCar]);

        $query = "DELETE FROM cars WHERE id=?";
        $stmt = $pdo->prepare($query);

        $stmt->execute([$idCar]);

        header("Location: homepage.php");
    }
    else{
        header("Location: homepage.php");
    }
}
else{
    header("Location: index.php");
}

?>