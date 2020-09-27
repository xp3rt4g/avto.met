<?php 

    include 'header.php';

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

    <div class="card-deck">

    <form action="loginProcess.php" method="post">

        <div class="card rounded shadow-box">

            <div class="card-header h-4 font-weight-bold">Prijava v avto.met</div>
            <div class="card-body">
                <label for="email" class="font-weight-bold">E-mail:</label>
                <div class="input-group mb-2 mr-sm-2 mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                    </div>
                    <input type="text" name="email" id="email" placeholder="Vpišite E-mail!" class="form-control form-control-lg">

                </div>

                <label for="password" class="w-100 font-weight-bold">
                    <div class="row">
                        <div class="col-6">Geslo:</div>
                        <div class="col-6 text-right">
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="showpass" id="showpass" onclick="showPass()"> Prikaži geslo</label>
                            </div>
                        </div>
                    </div>
                </label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-lock fa-2x"></i>
                        </div>
                    </div>
                    <input type="password" name="password" id="password" placeholder="Vpišite geslo!" class="form-control form-control-lg">
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