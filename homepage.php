<?php 

include_once 'header.php';

if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])){
    
    echo $_SESSION['user_id'];

}
else{
    header("Location: login.php");
}

?>