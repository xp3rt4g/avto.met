<?php 

include 'connect.php';
session_start();

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

function clean($string) {
    $string = str_replace('>', '', $string);
    $string = str_replace('<', '', $string);
    $string = str_replace('=', '', $string);
    $string = str_replace(';', '', $string);
 
    return $string;
 }

if(isset($_POST['name']) && isset($_POST['postCode']) && isset($_POST['street']) && isset($_POST['title']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) && isset($_POST['legal1']) && isset($_POST['legal2'])){

    if($_POST['password'] == $_POST['passwordConfirm']){

        $_SESSION['successRegister'] = 1;

        $name = $_POST['name'];
        $name = clean($name);
        $postCode = $_POST['postCode'];
        $street = $_POST['street'];
        $street = clean($street);
        $title = $_POST['title'];
        $title = clean($title);
        $phone = $_POST['phone'];
        $phone = clean($phone);
        $email = $_POST['email'];
        $email = clean($email);
        $password = $_POST['password'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM users WHERE email=?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        if($stmt->rowCount() != 0){
            $_SESSION['err'] = 4;
            header("Location: registerPerson.php");
        }
        else{

        $query = "INSERT INTO users (name, seller_title, address, phone, email, pass, account_type_id, town_id) VALUES (?,?,?,?,?,?,(SELECT id FROM account_types WHERE name = 'Posameznik'),?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $title, $street, $phone, $email, $password, $postCode]);
        
        $query = "SELECT u.id, u.name, at.name AS acc_type FROM users u INNER JOIN account_types at ON at.id=u.account_type_id WHERE u.email=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        $row = $stmt->fetch();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_type'] = $user['acc_type'];
        $_SESSION['user_name'] = $row['name'];

        header("Location: homepage.php");
        }
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