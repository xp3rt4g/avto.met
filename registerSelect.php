<?php

include_once 'header.php'

?>

<link rel="stylesheet" href="css/login.css">

<div class="container p-0">

    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
        <div class="row pt-3 pb-2 px-3">
            <div class="col-12 px-0">
                <h3 class="blue"><strong>Registracija</strong></h3>
            </div>
        </div>
    </div>


    <div class="row">
    
        <div class="col-sm-6 col-12">

            <div class="card shadow-box">
            
                <div class="card-body">
                <h5 class="blue">Ali želite objaviti oglas kot POSAMEZNIK?</h5>
                Prednosti registracije za fizične osebe:
                <ul>
                <li>Objava BREZPLAČNEGA oglasa</li>
                <li>Možnost parkiranja priljubljenih oglasov</li>
                <li>Lahko si shranite PRILJUBLJENE kriterije iskanja</li>
                </ul>

                Primerno za fizične osebe, kakor tudi za podjetja, ki želijo prodati lastno osnovno sredstvo
                </div>
                
                <div class="card-footer bg-white border-top-0 text-center">
            
                    <a href="registerPerson.php" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3">
                        <i class="fa fa-user fa-2x px-2 py-2"></i>
                        <span class="px-3 py-2 float-left">Registriraj kot POSAMEZNK</span>
                    </a>

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-12">
            <div class="card shadow-box">
            
                <div class="card-body">
                    <h5 class="blue">Ali želite objaviti oglas kot TRGOVEC?</h5>
                    Prednosti registracije kot trgovec:
                    <ul>
                    <li>Brezplačno 30-dnevno testno obdobje</li>
                    <li>Naprednejše možnosti objave oglasa</li>
                    <li>Brez omejitve oglasov!</li>
                    </ul>

                    Primerno za pravne osebe, ki želijo prodati več avtomobilov, ter se hočejo znebiti omejitve
                </div>
                
                <div class="card-footer bg-white border-top-0 text-center">
            
                <a href="registerCompany.php" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3">
                    <i class="fa fa-user fa-2x px-2 py-2"></i>
                    <span class="px-3 py-2 float-left">Registriraj kot TRGOVEC</span>
                </a>

                </div>



            
            </div>

        </div>

        
    
    </div>

</div>

<?php include_once 'footer.php'; ?>
