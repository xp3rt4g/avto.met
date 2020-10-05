<?php 

include_once 'header.php'

?>

<link rel="stylesheet" href="css/index.css">



<div class="container p-0">
    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
            <div class="row pt-3 pb-2 px-3">
                <div class="col-12 px-0">
                    <h3><strong>Pozabljeno geslo</strong></h3>
                </div>
            </div>
    </div>

    <?php

    if(isset($_SESSION['err'])){

        if($_SESSION['err'] == 50){
            echo "<div class='alert alert-danger' role='alert'>
            Napačen e-mail!
        </div>";
        unset($_SESSION['err']);
        }
        elseif($_SESSION['err'] == 55){
            echo "<div class='alert alert-danger' role='alert'>
            Račun je narejen z Facebook ali Google loginom.
        </div>";
        unset($_SESSION['err']);
        }
    }

    ?>

    <form action="forgotPassSend.php" method="post">

        <div class="card rounded shadow-box">
        <div class="card-body">
                <label for="email" class="font-weight-bold">E-mail:</label>
                <div class="input-group mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                    </div>
                    <input type="email" name="email" id="email" placeholder="Vpišite E-mail!" class="form-control form-control-lg" required>

                </div>
        </div>

        <div class="card-footer bg-white border-top-0 text-center">
            
                <button type="submit" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3">
                    <i class="fa fa-undo px-2 py-2"></i>
                    <span class="px-3 py-2 float-left">Ponastavi geslo!</span>
                </button>
                
        </div>
        </div>

    </form>

</div>