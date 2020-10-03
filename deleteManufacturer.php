<?php
session_start();
if(isset($_SESSION['user_type'])){
if($_SESSION['user_type'] == 'Admin'){

    if(isset($_GET['id'])){

        include 'connect.php';

        $id = $_GET['id'];

        $query = "SELECT * FROM models WHERE manufacturer_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        if($stmt->rowCount() != 0){
            $_SESSION['err'] = 8;
            header("Location: editManufacturers.php");
        }

        $query = "DELETE FROM manufacturers WHERE id=?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        header("Location: editManufacturers.php");
    }
    else{
        header("Location: index.php");
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