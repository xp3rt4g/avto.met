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

if(isset($_POST['name']) && isset($_POST['tax_number']) && isset($_POST['contact']) && isset($_POST['postCode']) && isset($_POST['street']) && isset($_POST['title']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) && isset($_POST['legal1']) && isset($_POST['legal2'])){

    if($_POST['password'] == $_POST['passwordConfirm']){

        $name = $_POST['name'];
        $name = clean($name);
        $tax_number = $_POST['tax_number'];
        $tax_number = clean($tax_number);
        $contact = $_POST['contact'];
        $contact = clean($contact);
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

        if(isset($_POST['website'])){
            $website = $_POST['website'];
        }
        else{
            $website = NULL;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM users WHERE email=?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        if($stmt->rowCount() != 0){
            $_SESSION['err'] = 4;
            header("Location: registerCompany.php");
        }
        else{

        $query = "INSERT INTO users (name, tax_number, seller_title, address, company_name, phone, email, webpage, pass, account_type_id, town_id) VALUES (?,?,?,?,?,?,?,?,?,(SELECT id FROM account_types WHERE name = 'Trgovec'),?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $tax_number, $title, $street, $name, $phone, $email, $website, $password, $postCode]);

        $query = "SELECT u.id, u.seller_title, at.name AS acc_type FROM users u INNER JOIN account_types at ON at.id=u.account_type_id WHERE u.email=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        $row = $stmt->fetch();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_type'] = $row['acc_type'];
        $_SESSION['user_name'] = $row['name'];

        header("Location: homepage.php");
        }
    }
    else{
        $_SESSION['err'] = 1;
        header("Location: registerCompany.php");
    }

}
elseif(isset($_POST['name']) && isset($_POST['postCode']) && isset($_POST['street']) && isset($_POST['title']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){
    $_SESSION['err'] = 2;
    header("Location: registerCompany.php");
}

?>