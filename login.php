<?php 

    include 'header.php';

?>
<link rel="stylesheet" href="css/login.css">


<div class="container p-0">
    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
            <div class="row pt-3 pb-2 px-3">
                <div class="col-12 px-0">
                    <h3><strong>Dobrodošli na moj.avto.net</strong></h3>
                </div>
            </div>
    </div>

    <div class="card-deck">

    <form action="loginProcess.php" method="post">

        <div class="card rounded shadow-box">

            <div class="card-header h-4 font-weight-bold">Prijava v avto.met</div>
            <div class="card-body">
                <label for="email">E-mail:</label>
                <div class="input-group mb-2 mr-sm-2 mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                    </div>
                    <input type="text" name="email" id="email" placeholder="Vpišite E-mail!" class="form-control form-control-lg">

                </div>
            </div>

        </div>

    </form>

    <div class="card rounded shadow-box">


    </div>


    </div>
</div>