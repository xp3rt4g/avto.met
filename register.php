<?php 

include 'connect.php';
session_Sta

/*echo $_POST['name']; 
echo $_POST['postCode'];
echo $_POST['street'];
echo $_POST['title'];
echo $_POST['phone'];
echo $_POST['email'];
echo $_POST['password'];
echo $_POST['passwordConfirm'];
if(isset($_POST['legal1'])){
    echo "1 ja";
};
if(isset($_POST['legal2'])){
    echo "2 ja";
};
*/

if(isset($_POST['name']) && isset($_POST['postCode']) && isset($_POST['street']) && isset($_POST['title']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) && isset($_POST['legal1']) && isset($_POST['legal2'])){

    if($_POST['password'] == $_POST['passwordConfirm']){

    }
    else{
        $_SESSION['err'] = 1;
        header("Location: registerPerson.php");
    }

}
elseif(isset($_POST['name']) && isset($_POST['postCode']) && isset($_POST['street']) && isset($_POST['title']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){
    $_SESSION['err'] = 2;
    header("Location: registerPerson.php");
}

?>