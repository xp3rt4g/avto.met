<?php
session_start();
if(isset($_SESSION['user_type'])){
if($_SESSION['user_type'] == 'Admin'){

    if(isset($_POST['name']) && isset($_POST['post-number'])){

        include_once 'connect.php';

        $name = $_POST['name'];
        $post_number = $_POST['post-number'];

        $query = "INSERT INTO towns (name, post_number) VALUES (?,?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $post_number]);

        header("Location: editCities.php");
    }
    else{
        header("Location: addCity.php");
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