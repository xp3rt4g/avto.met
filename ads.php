<?php

include_once 'header.php';

if(isset($_GET['id'])){

    include_once 'connect.php';

    $id_car  = $_GET['id'];

    $query = "SELECT * FROM cars WHERE id=?";

    $stmt = $pdo->prepare($query);

    $stmt->execute([$id_car]);

    if($stmt->rowCount() != 1){
        header("Location: index.php");
    }
    else{

        $row = $stmt->fetch();

        echo $row['type'];

    }

}
else{
    header("Location: index.php");
}

?>