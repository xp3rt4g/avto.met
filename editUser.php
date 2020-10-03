<?php 
include_once 'header.php';

if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type'] == 'Admin'){
    
        if(isset($_GET['id'])){
    
            include 'connect.php';
    
            $id = $_GET['id'];
    
            $query = "SELECT * FROM users WHERE id=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);

            $user = $stmt->fetch()
?>

<link rel="stylesheet" href="css/login.css">


<div class="container p-0">

    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
        <div class="row pt-3 pb-2 px-3">
            <div class="col-12 px-0">
                <h3 class="blue"><strong>Urejanje podatkov</strong></h3>
            </div>
        </div>
    </div>

    <div class="card shadow-box">
    
    <form action="editUserSend.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo $id ?>">
    
        <div class="card-body">
        
            <h4>Naziv</h4>
            <hr>
            <div class="form-group row">
                <label for="name" class="text-muted col-sm-2 col-form-label">Ime:</label>
                <input type="text" name="name" id="name" maxlength="25" class="form-control col-sm-10" value="<?php echo $user['name'] ?>" required>
            </div>
            <div class="form-group row">
                <label for="contact" class="text-muted col-sm-2 col-form-label">Ime kontakta:</label>
                <input type="text" name="contact" id="contact" maxlength="25" class="form-control col-sm-10" value="<?php echo $user['seller_title'] ?>" required>
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
                        if($row['id'] == $user['town_id']){
                            echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
                        }
                        else{
                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        }
                    }
                    
                    ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="street" class="text-muted col-sm-2 col-form-label">Naslov:</label>
                <input type="text" name="street" id="street" class="form-control col-sm-10" value="<?php echo $user['address'] ?>" required>
            </div>

            <h4 class="mt-4">Kontaktni podatki</h4>
            <hr>

            <div class="form-group row">
                <label for="phone" class="text-muted col-sm-2 col-form-label">Telefon:</label>
                <input type="text" name="phone" id="phone" class="form-control col-sm-10" maxlength="12" value="<?php echo $user['phone'] ?>" required>
            </div>

            <div class="form-group row">
                <label for="email" class="text-muted col-sm-2 col-form-label">E-mail naslov:</label>
                <input type="email" name="email" id="email" class="form-control col-sm-10" placeholder="Podatek je obveen vendar ne bo objavljen!" value="<?php echo $user['email'] ?>" required>
            </div>

            <h4 class="mt-4">Vrsta računa</h4>
            <hr>

            <div class="form-group row">
                <label for="acc_type" class="text-muted col-sm-2 col-form-label">Vrsta računa:</label>
                <select name="acc_type" id="acc_type" class="form-control col-sm-10">
                    <?php 
                    
                    include_once 'connect.php';

                            $query = "SELECT * FROM account_types ORDER BY name;";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();

                            while ($row = $stmt->fetch()) {
                                if($row['id'] == $user['account_type_id']){
                                    echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
                                }
                                else{
                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                            }
                    
                    ?>
                </select>
            </div>


            <button type="submit" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3 text-align-center">
                    <span class="px-3 py-2">Shrani spremembe</span>
            </button>

        </div>
    
    </form>
    
    </div>


</div>

<?php include_once 'footer.php'; ?>



        <?php
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