<?php

session_start();
include 'connect.php';

if(isset($_POST['email']) && isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
   # echo $name . " - " . $email;

    $query = "SELECT u.*, ac.name AS account_type FROM users u INNER JOIN account_types ac ON ac.id=u.account_type_id WHERE u.email=?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);

    if($stmt->rowCount() == 1){
        $user = $stmt->fetch();
        if($user['pass'] == 'social'){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['account_type'];
            $_SESSION['user_name'] = $user['seller_title'];
            header("Location: homepage.php");
            die();
        }
        else{
            $_SESSION['err'] = 100;
            header("Location: login.php");
        }
    }
    elseif($stmt->rowCount() == 0){
        include_once 'header.php'
        ?>
        <link rel="stylesheet" href="css/login.css">

        <div class="container p-0">

    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
        <div class="row pt-3 pb-2 px-3">
            <div class="col-12 px-0">
                <h3 class="blue"><strong>Registracija z socialnimi omrežji</strong></h3>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['err'])){
            $err = $_SESSION['err'];

            if($err == 2){
                echo    "<div class='alert alert-danger' role='alert'>Za registracijo se morate strinjati z pravnim obvestilom!</div>";
                $err = NULL;
                unset($_SESSION['err']);
            }
            elseif($err == 3){
                echo    "<div class='alert alert-danger' role='alert'>Prišlo je do neznane napake, prosimo poskusite ponovno!</div>";
                $err = NULL;
                unset($_SESSION['err']);
            }
        }



    ?>

    <div class="card shadow-box">
    
    <form action="" method="post">
    
        <div class="card-body">
        
            <h4>Osnovni podatki</h4>
            <hr>
            <div class="form-group row">
                <label for="name" class="text-muted col-sm-2 col-form-label">Ime in Priimek:</label>
                <input type="text" name="name" id="name" maxlength="25" value="<?php echo $name ?>" class="form-control col-sm-10" readonly>
            </div>
            <div class="form-group row">
                <label for="country" class="text-muted col-sm-2 col-form-label">Država:</label>
                <input type="text" name="country" id="country" value="Slovenija" class="form-control col-sm-10" readonly>
            </div>
            <div class="form-group row">
                <label for="postCode" class="text-muted col-sm-2 col-form-label">Pošta oz. kraj:</label>
                <select name="postCode" id="postCode" class="form-control col-sm-10">
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM towns ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="street" class="text-muted col-sm-2 col-form-label">Naslov:</label>
                <input type="text" name="street" id="street" class="form-control col-sm-10" placeholder="Podatek je obvezen vendar ne bo objavljen!" required>
            </div>

            <h4 class="mt-4">Kontaktni podatki za objavo ob oglasu</h4>
            <hr>

            <div class="form-group row">
                <label for="title" class="text-muted col-sm-2 col-form-label">Naziv prodajalca:</label>
                <input type="text" name="title" id="title" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="phone" class="text-muted col-sm-2 col-form-label">Telefon:</label>
                <input type="text" name="phone" id="phone" class="form-control col-sm-10" maxlength="12" required>
            </div>

            <div class="form-group row">
                <label for="email" class="text-muted col-sm-2 col-form-label">E-mail naslov:</label>
                <input type="email" name="email" id="email" class="form-control col-sm-10" value="<?php echo $email ?>" readonly>
            </div>

            <hr>

            <button type="submit" name="submitButton" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3 text-align-center">
                    <span class="px-3 py-2">BREZPLAČNA registracija</span>
            </button>

        </div>
    
    </form>
    
    </div>


</div>


        <?php
    }
if(isset($_POST['submitButton'])){
    if(isset($_POST['street']) && isset($_POST['postCode']) && isset($_POST['title']) && isset($_POST['phone'])){
        $street = $_POST['street'];
        $postcode = $_POST['postCode'];
        $title = $_POST['title'];
        $phone = $_POST['phone'];
        $pass = "social";

        $query = "INSERT INTO users (name, seller_title, address, phone, email, pass, account_type_id, town_id) VALUES (?,?,?,?,?,?, (SELECT id FROM account_types WHERE name = 'Posameznik'),?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $title, $street, $phone, $email, $pass, $postcode]);

        $query = "SELECT u.id, u.name, at.name AS acc_type FROM users u INNER JOIN account_types at ON at.id=u.account_type_id WHERE u.email=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        $row = $stmt->fetch();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_type'] = $user['acc_type'];
        $_SESSION['user_name'] = $row['name'];

        echo "<script>window.location.href='homepage.php'</script>";
    }
}

}


?>