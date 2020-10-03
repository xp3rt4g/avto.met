<?php

include_once 'header.php';

?>

<link rel="stylesheet" href="css/login.css">


<div class="container p-0">

    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
        <div class="row pt-3 pb-2 px-3">
            <div class="col-12 px-0">
                <h3 class="blue"><strong>Dodajanje novega oglasa</strong></h3>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['err'])){
            $err = $_SESSION['err'];

            if($err == 12){
                echo    "<div class='alert alert-danger' role='alert'>Datoteka ki ste jo prenesli ni slika!!</div>";
                $err = NULL;
                unset($_SESSION['err']);
            }
            elseif($err == 13){
                echo    "<div class='alert alert-danger' role='alert'>Slika ki ste jo prenesli je prevelika!</div>";
                $err = NULL;
                unset($_SESSION['err']);
            }
            elseif($err == 15){
                echo    "<div class='alert alert-danger' role='alert'>Datoteka mora biti JPG, PNG, JPEG ali GIF!</div>";
                $err = NULL;
                unset($_SESSION['err']);
            }
            elseif($err == 14){
                echo "<div class='alert alert-danger' role='alert'>Napaka pri nalaganju slike!</div>";
                $err = NULL;
                unset($_SESSION['err']);
            }
            elseif($err == 16){
                echo "<div class='alert alert-danger' role='alert'>Za objavo oglasa se morate strinjati z vsebino pravnega obvestila!</div>";
                $err = NULL;
                unset($_SESSION['err']);
            }
        }



    ?>

    <div class="card shadow-box">
    
    <form action="addCarProcess.php" method="post" enctype="multipart/form-data">
    
        <div class="card-body">
        
            <h4>Osnovni podatki</h4>
            <hr>
            <div class="form-group row">
                <label for="manufacturer" class="text-muted col-sm-2 col-form-label">Znamka:</label>
                <select name="manufacturer" id="manufacturer" class="form-control col-sm-10">
                <option>Izberi znamko</option>
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM manufacturers ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <label for="model" class="text-muted col-sm-2 col-form-label">Model:</label>
                <select name="model" id="model" class="form-control col-sm-10">
                <option>Izberi model</option>
                <script type="text/javascript">
                                    $(document).ready(function(e) {
                                        $('#manufacturer').change(function(e) { // When the select is changed
                                            var sel_value = $(this).val(); // Get the chosen value
                                            $.ajax({
                                                type: "POST",
                                                url: "ajax_load_models.php", // The new PHP page which will get the option value, process it and return the possible options for second select
                                                data: {
                                                    selected_option: sel_value
                                                }, // Send the slected option to the PHP page
                                                dataType: "HTML",
                                                success: function(data) {

                                                    $('#model').find('option').remove()
                                                    .end().append(
                                                    data); // Append the possible values to the second select
                                                }
                                            });
                                        });
                                    });
                </script>
                </select>
            </div>
            <div class="form-group row">
                <label for="type" class="text-muted col-sm-2 col-form-label">Dodatno ime:</label>
                <input type="text" name="type" id="type" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="car_type" class="text-muted col-sm-2 col-form-label">Tip avta:</label>
                <select name="car_type" id="car_type" class="form-control col-sm-10">
                <option>Izberi tip</option>
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM car_types ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <label for="vehicle_status" class="text-muted col-sm-2 col-form-label">Stanje avta:</label>
                <select name="vehicle_status" id="vehicle_status" class="form-control col-sm-10">
                <option>Izberi stanje</option>
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM vehicle_status ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <label for="manufacture_year" class="text-muted col-sm-2 col-form-label">Letnik izdelave:</label>
                <input type="number" name="manufacture_year" max="2999" min="1900" id="type" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="first_registration" class="text-muted col-sm-2 col-form-label">Prva registracija:</label>
                <input type="date" name="first_registration" id="first_registration" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="inspection_expiry" class="text-muted col-sm-2 col-form-label">Tehnični do:</label>
                <input type="date" name="inspection_expiry" id="inspection_expiry" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="color" class="text-muted col-sm-2 col-form-label">Barva avta:</label>
                <select name="color" id="color" class="form-control col-sm-10">
                <option>Izberi barvo</option>
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM colors ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
            <div class="col-sm-2"></div>
                <div class="form-check pretty p-icon p-rotate">
                    <input name="metallic" class="form-check-input" type="checkbox" value="1" id="metallic">
                    <div class="state p-danger-o">
                        <i class="icon fa fa-check"></i>
                        <label class="form-check-label" for="metallic">
                            Metallic
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="ownership" class="text-muted col-sm-2 col-form-label">Podatki o lastništvu:</label>
                <select name="ownership" id="ownership" class="form-control col-sm-10">
                <option>Izberi lastništvo</option>
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM number_of_owners ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <label for="mileage" class="text-muted col-sm-2 col-form-label">Prevoženi kilometri:</label>
                <input type="number" name="mileage" id="mileage" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="doors" class="text-muted col-sm-2 col-form-label">Število vrat:</label>
                <input type="number" name="doors" id="doors" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="seats" class="text-muted col-sm-2 col-form-label">Število sedežev:</label>
                <input type="number" name="seats" id="seats" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="airbags" class="text-muted col-sm-2 col-form-label">Število airbagov:</label>
                <input type="number" name="airbags" id="airbags" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="comment" class="text-muted col-sm-2 col-form-label">Komentar:</label>
                <input type="textarea" name="comment" id="comment" class="form-control col-sm-10" required>
            </div>

            <h4 class="mt-4">Podatki o motorju</h4>
            <hr>

            <div class="form-group row">
                <label for="fuel" class="text-muted col-sm-2 col-form-label">Gorivo:</label>
                <select name="fuel" id="fuel" class="form-control col-sm-10">
                <option>Izberi gorivo</option>
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM fuel_types ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <label for="gearbox" class="text-muted col-sm-2 col-form-label">Menjalnik:</label>
                <select name="gearbox" id="gearbox" class="form-control col-sm-10">
                <option>Izberi menjalnik</option>
                    <?php
                    
                    include_once 'connect.php';

                    $query = "SELECT * FROM gearboxes ORDER BY name;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <label for="power" class="text-muted col-sm-2 col-form-label">Moč (v kW):</label>
                <input type="number" name="power" id="power" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="ccm" class="text-muted col-sm-2 col-form-label">Prostornina motorja ccm:</label>
                <input type="number" name="ccm" id="ccm" class="form-control col-sm-10" required>
            </div>

            <div class="form-group row">
                <label for="consumption" class="text-muted col-sm-2 col-form-label">Poraba (l/100km):</label>
                <input type="number" name="consumption" id="consumption" class="form-control col-sm-10" required>
            </div>

            <h4 class="mt-4">Dodatna oprema:</h4>
            <hr>



            <div class="col-12 pl-0 pb-4"><strong>Klimatizacija</strong></div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="ac" class="form-check-input" type="checkbox" value="1" id="ac">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="ac">
                                            klima
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="digital_ac" class="form-check-input" type="checkbox" value="1" id="digital_ac">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="ac">
                                            digitalna klima
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-12 pl-0 py-4"><strong>Notranja oprema</strong></div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="keyless" class="form-check-input" type="checkbox" value="1" id="keyless">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="keyless">
                                            keyless go
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="headup" class="form-check-input" type="checkbox" value="1" id="headup">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="headup">
                                            HeadUp display
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="navigation" class="form-check-input" type="checkbox" value="1" id="navigation">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="navigation">
                                            navigacija
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="cd_player" class="form-check-input" type="checkbox" value="1" id="cd_player">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="cd_player">
                                            CD predvajalnik
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="mp3_player" class="form-check-input" type="checkbox" value="1" id="mp3_player">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="mp3_player">
                                            MP3 predvajalnik
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="dab" class="form-check-input" type="checkbox" value="1" id="dab">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="dab">
                                            DAB radio
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="electric_parking_brake" class="form-check-input" type="checkbox" value="1" id="electric_parking_brake">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="electric_parking_brake">
                                            električna ročna zavora
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-12 pl-0 py-3"><strong>Varnost</strong></div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="abs" class="form-check-input" type="checkbox" value="1" id="abs">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="abs">
                                            ABS sistem
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="fourwheel" class="form-check-input" type="checkbox" value="1" id="fourwheel">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="fourwheel">
                                            štirikolesni pogon
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="alarm" class="form-check-input" type="checkbox" value="1" id="alarm">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="alarm">
                                            alarm
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="xenon" class="form-check-input" type="checkbox" value="1" id="xenon">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="xenon">
                                            xenon žarometi
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="led" class="form-check-input" type="checkbox" value="1" id="led">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="led">
                                            LED žarometi
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="automatic_lights" class="form-check-input" type="checkbox" value="1" id="automatic_lights">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="automatic_lights">
                                            avtomatske luči
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="emergency_brake" class="form-check-input" type="checkbox" value="1" id="emergency_brake">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="emergency_brake">
                                            zaviranje v sili
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="cruise_control" class="form-check-input" type="checkbox" value="1" id="cruise_control">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="cruise_control">
                                            tempomat
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="hill_assist" class="form-check-input" type="checkbox" value="1" id="hill_assist">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="hill_assist">
                                            pomoč za speljevanje v klanec
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-12 pl-0 py-4"><strong>Pomoč pri parkiranju</strong></div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="pdc" class="form-check-input" type="checkbox" value="1" id="pdc">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="pdc">
                                            parkirni senzorji
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="rear_camera" class="form-check-input" type="checkbox" value="1" id="rear_camera">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="rear_camera">
                                            parkirna kamera
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-12 pl-0 py-4"><strong>Lastništvo</strong></div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="service_book" class="form-check-input" type="checkbox" value="1" id="service_book">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="service_book">
                                            servisna knjiga
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="slovenian" class="form-check-input" type="checkbox" value="1" id="slovenian">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="slovenian">
                                            slovensko poreklo
                                        </label>
                                    </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="oldtimer" class="form-check-input" type="checkbox" value="1" id="oldtimer">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="oldtimer">
                                            oldtimer
                                        </label>
                                    </div>
                            </div>
                        </div>


                        <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="garaged" class="form-check-input" type="checkbox" value="1" id="garaged">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="garaged">
                                            garažiran
                                        </label>
                                    </div>
                            </div>
                        </div>
            
            <h4 class="mt-4">Cena:</h4>
            <hr>

            <div class="form-group row">
                <label for="price" class="text-muted col-sm-2 col-form-label">Cena:</label>
                <input type="number" name="price" id="price" class="form-control col-sm-10" required>
            </div>

            <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="cash_discount" class="form-check-input" type="checkbox" value="1" id="cash_discount">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="cash_discount">
                                            gotovinski popust
                                        </label>
                                    </div>
                            </div>
            </div>

            <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="last_price" class="form-check-input" type="checkbox" value="1" id="last_price">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="last_price">
                                            zadnja cena
                                        </label>
                                    </div>
                            </div>
            </div>

            <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="warranty" class="form-check-input" type="checkbox" value="1" id="warranty">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="warranty">
                                            garancija
                                        </label>
                                    </div>
                            </div>
            </div>


            <div class="col-6 col-sm-4 p-0">
                            <div class="form-check pretty p-icon p-rotate m-2">
                                    <input name="guarranty" class="form-check-input" type="checkbox" value="1" id="guarranty">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="guarranty">
                                            jamstvo
                                        </label>
                                    </div>
                            </div>
            </div>

            <h4 class="mt-4">Slika:</h4>
            <hr>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Naloži</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image"
                  aria-describedby="inputGroupFileAddon01" required>
                <label class="custom-file-label" for="image">Izberi sliko</label>
              </div>
            </div>
            
            <script>
                $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>


            <hr class="mb-4 mt-4">
            <div class="form-check pretty p-icon p-rotate mb-4">
                <input name="legal1" class="form-check-input" type="checkbox" value="legal1" id="legal1">
                <div class="state p-danger-o">
                <i class="icon fa fa-check"></i>
                <label class="form-check-label" for="defaultCheck1">
                    Izjavljam, da prodajam avto, ki je v moji lasti.
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
                    <span class="px-3 py-2">BREZPLAČNA objava oglasa</span>
            </button>

        </div>
    
    </form>
    
    </div>


</div>