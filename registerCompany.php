<?php 
include_once 'header.php';

?>

<link rel="stylesheet" href="css/login.css">


<div class="container p-0">

    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
        <div class="row pt-3 pb-2 px-3">
            <div class="col-12 px-0">
                <h3 class="blue"><strong>Registracija novega posameznika</strong></h3>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['err'])){
            $err = $_SESSION['err'];

            if($err == 1){
                echo    "<div class='alert alert-danger' role='alert'>Gesli se morata ujemati!</div>";
                $err = NULL;
                $_SESSION['err'] = NULL;
            }
            elseif($err == 2){
                echo    "<div class='alert alert-danger' role='alert'>Za registracijo se morate strinjati z pravnim obvestilom!</div>";
                $err = NULL;
                $_SESSION['err'] = NULL;
            }
            elseif($err == 3){
                echo    "<div class='alert alert-danger' role='alert'>Prišlo je do neznane napake, prosimo poskusite ponovno!</div>";
                $err = NULL;
                $_SESSION['err'] = NULL;
            }
            elseif($err == 4){
                echo "<div class='alert alert-danger' role='alert'>Uporabnik s tem emailom že obstaja!</div>";
                $err = NULL;
                $_SESSION['err'] = NULL;
            }
        }



    ?>

    <div class="card shadow-box">
    
    <form action="registerCompanySend.php" method="post">
    
        <div class="card-body">
        
            <h4>Naziv</h4>
            <hr>
            <div class="form-group row">
                <label for="name" class="text-muted col-sm-2 col-form-label">Naziv podjetja:</label>
                <input type="text" name="name" id="name" maxlength="25" class="form-control col-sm-10" required>
            </div>
            <div class="form-group row">
                <label for="tax_number" class="text-muted col-sm-2 col-form-label">Davčna številka:</label>
                <input type="text" name="tax_number" id="tax_number" maxlength="10" class="form-control col-sm-10" required>
            </div>
            <div class="form-group row">
                <label for="contact" class="text-muted col-sm-2 col-form-label">Kontaktna oseba:</label>
                <input type="text" name="contact" id="contact" maxlength="25" class="form-control col-sm-10" required>
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
                <input type="text" name="street" id="street" class="form-control col-sm-10" required>
            </div>

            <h4 class="mt-4">Kontaktni podatki</h4>
            <hr>

            <div class="form-group row">
                <label for="title" class="text-muted col-sm-2 col-form-label">Naziv poslovalnice:</label>
                <input type="text" name="title" id="title" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="phone" class="text-muted col-sm-2 col-form-label">Telefon:</label>
                <input type="text" name="phone" id="phone" class="form-control col-sm-10" maxlength="12" required>
            </div>

            <div class="form-group row">
                <label for="email" class="text-muted col-sm-2 col-form-label">E-mail naslov:</label>
                <input type="email" name="email" id="email" class="form-control col-sm-10" placeholder="Podatek je obveen vendar ne bo objavljen!" required>
            </div>
            <div class="form-group row">
                <label for="website" class="text-muted col-sm-2 col-form-label">Spletna stran:</label>
                <input type="text" name="website" id="website" class="form-control col-sm-10" placeholder="Podatek ni obvezen!s">
            </div>

            <h4 class="mt-4">Vpišite željeno geslo (minimalno 6 znakov)</h4>
            <hr>

            <div class="form-group row">
                <label for="password" class="text-muted col-sm-2 col-form-label">Vaše geslo:</label>
                <input type="password" name="password" id="password" class="form-control col-sm-10" minlength="6" required>
            </div>

            <div class="form-group row">
                <label for="passwordConfirm" class="text-muted col-sm-2 col-form-label">Ponovite geslo:</label>
                <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control col-sm-10" minlength="6" required>
            </div>

            <hr class="mb-4 mt-4">
            <div class="form-check pretty p-icon p-rotate mb-4">
                <input name="legal1" class="form-check-input" type="checkbox" value="legal1" id="legal1">
                <div class="state p-danger-o">
                <i class="icon fa fa-check"></i>
                <label class="form-check-label" for="defaultCheck1">
                    Izvjavljamo, da imamo dejavnost opredeljeno v ustanovitvenem aktu oziroma vpisano v register.
                </label>
                </div>
            </div>

            <div class="form-check pretty p-icon p-rotate mb-4">
                <input name="legal2" class="form-check-input" type="checkbox" value="legal2" id="legal2">
                <div class="state p-danger-o">
                <i class="icon fa fa-check"></i>
                <label class="form-check-label" for="legal1">
                    Potrjujem seznanitev z vsebino pravnega obvsetila in se z njim v celoti strinjam.
                </label>
                </div>
            </div>

            <hr>

            <button type="submit" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3 text-align-center">
                    <span class="px-3 py-2">BREZPLAČNA registracija</span>
            </button>

        </div>
    
    </form>
    
    </div>


</div>

<?php include_once 'footer.php'; ?>
