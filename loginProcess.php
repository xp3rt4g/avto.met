<?php 
    session_start();
    include_once 'connect.php';

    if(isset($_POST['email']) && isset($_POST['password'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email=?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        if($stmt->rowCount() == 1){

            $user = $stmt->fetch();
            if(password_verify($password, $user['pass'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['account_type_id'];
                $_SESSION['user_name'] = $user['seller_title'];
                header("Location: homepage.php");
                die();
            }
        }
    }

?>