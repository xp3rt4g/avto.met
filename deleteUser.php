<?php
session_start();
if(isset($_SESSION['user_type'])){
if($_SESSION['user_type'] == 'Admin'){

    if(isset($_GET['id'])){

        include 'connect.php';

        $id = $_GET['id'];

        $query = "SELECT * FROM cars WHERE user_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        if($stmt->rowCount() != 0){
            $_SESSION['err'] = 10;
            header("Location: editUsers.php");
        }

        $query = "DELETE FROM users WHERE id=?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        header("Location: editUsers.php");
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