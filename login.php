<?php 

    include 'header.php';

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_type'])){
        header("Location: homepage.php");
    }
    else{
?>
<link rel="stylesheet" href="css/login.css">


<div class="container p-0">
    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
            <div class="row pt-3 pb-2 px-3">
                <div class="col-12 px-0">
                    <h3><strong>Dobrodošli na moj.avto.met</strong></h3>
                </div>
            </div>
    </div>
    <?php

    if(isset($_SESSION['successRegister'])){
        $success = $_SESSION['successRegister'];

        if($success == 1){
            echo "<div class='alert alert-success' role='alert'>
                Uspešno ste se registrirali na avto.met. Lahko nadaljujete s prijavo!
            </div>";
            $success = NULL;
            $_SESSION['successRegister'] = NULL;
        }
    }

    ?>
    <div class="card-deck">

    <form action="loginProcess.php" method="post">

        <div class="card rounded shadow-box">

            <div class="card-header h4 font-size-l">Prijava v avto.met</div>
            <div class="card-body">
                <label for="email" class="font-weight-bold">E-mail:</label>
                <div class="input-group mb-2 mr-sm-2 mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                    </div>
                    <input type="email" name="email" id="email" placeholder="Vpišite E-mail!" class="form-control form-control-lg" required>

                </div>

                <label for="password" class="w-100 font-weight-bold">
                    <div class="row">
                        <div class="col-6">Geslo:</div>
                        <div class="col-6 text-right">
                            <div class="pretty p-switch p-slim">
                                <input type="checkbox" name="showpass" id="showpass" onclick="showPass()">
                                <div class="state">
                                    <label> Prikaži geslo</label>
                                </div>
                            </div>

                            <!-- 

                            <div class="pretty p-icon p-toggle p-plain">
                                <input type="checkbox" name="showpass" id="showpass" onclick="showPass()">
                                <div class="state p-success-o p-on">
                                    <i class="icon fa fa-eye"></i>
                                    <label>Skrij geslo</label>
                                </div>
                                <div class="state p-off">
                                    <i class="icon fa fa-eye-slash"></i>
                                    <label>Pokaži geslo</label>
                                </div>
                            </div>

                            -->
                        </div>
                    </div>
                </label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-lock fa-2x"></i>
                        </div>
                    </div>
                    <input type="password" name="password" id="password" placeholder="Vpišite geslo!" class="form-control form-control-lg" required>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0 text-center">
            
                <button type="submit" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3">
                    <i class="fa fa-user px-2 py-2"></i>
                    <span class="px-3 py-2 float-left">Prijava</span>
                </button>

                <a href="forgottenPassword.php">
                    <span class="black">
                        Pozabljeno geslo?
                    </span>
                </a>
            
            </div>

        </div>

    </form>

    <div class="card rounded shadow-box">

        <div class="card-header h4">Registracija na avto.met</div>
        <div class="card-body font-weight-normal">
            Kaj pridobite z registracijo:
            <ul>
                <li>objavljanje oglasov kot POSAMEZNIK</li>
                <li>objavljanje večih oglasov kot TRGOVEC</li>
                <li>shranjevanje priljubljenih kriterijev iskanja</li>
                <li>shranjevanje priljubljenih avtomobilov</li>
            </ul>
            Število objav je lahko omejeno odvisno od tipa registracije in naročniškega razmerja!
        </div>
        <div class="card-footer bg-white border-top-0 text-center">
        
            <a href="registerSelect.php" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3">
                <i class="fa fa-pencil text-white px-2 py-2"></i>
                <span class="text-white font-weight-bold px-3 py-2 float-left">Registriraj se!</span>
            </a>
            <a href="#"><span class="invisible">.</span></a>
        
        </div>
    </div>


    </div>
</div>

<script>

function showPass() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>

<?php } include_once 'footer.php'; ?>
