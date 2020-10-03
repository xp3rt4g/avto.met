<?php
session_start();
if(isset($_SESSION['user_type'])){
if($_SESSION['user_type'] == 'Admin'){

    if(isset($_GET['id'])){

        include 'connect.php';

        $id = $_GET['id'];

        $query = "SELECT * FROM users WHERE town_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        if($stmt->rowCount() != 0){
            $_SESSION['err'] = 7;
            header("Location: editCities.php");
        }

        $query = "DELETE FROM towns WHERE id=?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        header("Location: editCities.php");
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