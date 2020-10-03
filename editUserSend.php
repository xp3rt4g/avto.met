<?php

include 'connect.php';

if(isset($_POST['user_id']) && isset($_POST['name']) && isset($_POST['postCode']) && isset($_POST['contact']) && isset($_POST['street']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['acc_type'])){

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $postNumber = $_POST['postCode'];
    $street = $_POST['street'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $acc_type = $_POST['acc_type'];
    $id = $_POST['user_id'];

    $query = "UPDATE users SET name=?, seller_title=?, town_id=?, address=?, phone=?, email=?, account_type_id=? WHERE id=?;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $contact, $postNumber, $street, $phone, $email, $acc_type, $id]);

    header("Location: editUsers.php");
}
else{
    header("Location: index.php");
}

?>