<?php 
include_once 'header.php';
include 'connect.php';
?>

<link rel="stylesheet" href="css/car_search.css">

<div class="container p-0">
    <div class="row bg-white rounded-bottom shadow-box pt-3 pb-2 m-0 mb-3">
        <div class="col-12">
            <h4>Podrobno iskanje</h4>
        </div>
    </div>

    <div class="container my-3 pb-2">
        <div class="row">
            <div class="col-12 pr-sm-3">
                <form action="search.php" method="get">
                    <input type="hidden" name="search_type" value="advanced">
                    <div class="row bg-white shadow-box px-3 pt-2 pb-2 mb-2">
                        <div class="col-12 border-bottom p-0 mb-3">
                            <h5><strong>Starost</strong></h5>
                        </div>
                        <div class="col-12 col-sm-4 p-0 font-weight-normal">
                            <div class="form-check pretty p-icon p-rotate mb-4">
                                <input name="novo" class="form-check-input" type="checkbox" checked="checked" value="1" id="novo">
                                <div class="state p-danger-o">
                                <i class="icon fa fa-check"></i>
                                <label class="form-check-label" for="novo">
                                    novo
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 p-0 font-weight-normal">
                            <div class="form-check pretty p-icon p-rotate mb-4">
                                <input name="testno" class="form-check-input" type="checkbox" checked="checked" value="1" id="testno">
                                <div class="state p-danger-o">
                                <i class="icon fa fa-check"></i>
                                <label class="form-check-label" for="novo">
                                    testno
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 p-0 font-weight-normal">
                            <div class="form-check pretty p-icon p-rotate mb-4">
                                <input name="rabljeno" class="form-check-input" type="checkbox" checked="checked" value="1" id="rabljeno">
                                <div class="state p-danger-o">
                                <i class="icon fa fa-check"></i>
                                <label class="form-check-label" for="rabljenno">
                                    rabljeno
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white shadow-box px-3 pt-2 pb-2 mb-2">
                        <div class="col-12 border-bottom p-0 mb-3">
                            <h5><strong>Karoserijska izvedba</strong></h5>
                        </div>
                        <div class="col-12 col-sm-4 p-0 font-weight-normal">
                            <div class="form-check pretty p-icon p-curve p-rotate mb-4">
                                <input name="car_type" class="form-check-input" type="radio" value="all" id="car_type" checked="checked">
                                <div class="state p-danger-o">
                                <i class="icon fa fa-check"></i>
                                <label class="form-check-label" for="car_type">
                                    Katerakoli
                                </label>
                                </div>
                            </div>
                        </div>
                        <?php 
                        
                        $query = "SELECT * FROM car_types";

                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        while ($row = $stmt->fetch()){ ?>

                        <div class="col-12 col-sm-4 p-0 font-weight-normal">
                            <div class="form-check pretty p-icon p-curve p-rotate mb-4">
                                <input name="car_type" class="form-check-input" type="radio" value="<?php echo $row['id'] ?>" id="car_type">
                                <div class="state p-danger-o">
                                <i class="icon fa fa-check"></i>
                                <label class="form-check-label" for="car_type">
                                    <?php echo $row['name'] ?>
                                </label>
                                </div>
                            </div>
                        </div>

                        <?php }
                        
                        ?>
                    </div>

                    <div class="row bg-white shadow-box px-3 pt-2 pb-2 mb-2">
                        <div class="col-12 border-bottom p-0 mb-3">
                            <h5><strong>Znamka, model in tip</strong></h5>
                        </div>

                        <div class="col-12 col-sm-6 p-0 pr-3">
                            <label for="manufacturer" class="m-0"><strong>Znamka</strong></label>
                            <select name="manufacturer" id="manufacturer" class="custom-select">
                                <option value="all">Vse znamke</option>
                                <?php 
                                
                                $query = "SELECT * FROM manufacturers ORDER BY name;";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
    
                                while ($row = $stmt->fetch()) {
                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 p-0 pr-3">
                            <label for="model" class="m-0"><strong>Model</strong></label>
                            <select name="model" id="model" class="custom-select">
                                <option value="all">Vsi modeli</option>
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
                    </div>

                    <div class="row bg-white shadow-box px-3 pt-2 pb-2 mb-2">
                        <div class="col-12 border-bottom p-0 mb-3">
                            <h5><strong>Cena, letnik, prevoženi kilometri</strong></h5>
                        </div>
                        
                        <label for="priceFrom" class="col-12 p-0 m-0"><strong>Cena</strong></label>
                        <div class="col-12 col-sm-8 p-0 pr-3 input-group">
                            <select name="priceFrom" id="priceFrom" class="custom-select">     
                                <option value="0">Cena od</option>
                                <option value="100">od 100 EUR</option>
                                <option value="500">od 500 EUR</option>
                                <option value="1000">od 1.000 EUR</option>
                                <option value="1500">od 1.500 EUR</option>
                                <option value="2000">od 2.000 EUR</option>
                                <option value="2500">od 2.500 EUR</option>
                                <option value="3000">od 3.000 EUR</option>
                                <option value="3500">od 3.500 EUR</option>
                                <option value="4000">od 4.000 EUR</option>
                                <option value="4500">od 4.500 EUR</option>
                                <option value="5000">od 5.000 EUR</option>
                                <option value="6000">od 6.000 EUR</option>
                                <option value="7000">od 7.000 EUR</option>
                                <option value="8000">od 8.000 EUR</option>
                                <option value="9000">od 9.000 EUR</option>
                                <option value="10000">od 10.000 EUR</option>
                                <option value="11000">od 11.000 EUR</option>
                                <option value="12000">od 12.000 EUR</option>
                                <option value="13000">od 13.000 EUR</option>
                                <option value="14000">od 14.000 EUR</option>
                                <option value="15000">od 15.000 EUR</option>
                                <option value="16000">od 16.000 EUR</option>
                                <option value="17000">od 17.000 EUR</option>
                                <option value="18000">od 18.000 EUR</option>
                                <option value="19000">od 19.000 EUR</option>
                                <option value="20000">od 20.000 EUR</option>
                                <option value="22500">od 22.500 EUR</option>
                                <option value="25000">od 25.000 EUR</option>
                                <option value="27500">od 27.500 EUR</option>
                                <option value="30000">od 30.000 EUR</option>
                                <option value="35000">od 35.000 EUR</option>
                                <option value="40000">od 40.000 EUR</option>
                                <option value="45000">od 45.000 EUR</option>
                                <option value="50000">od 50.000 EUR</option>
                                <option value="60000">od 60.000 EUR</option>
                                <option value="70000">od 70.000 EUR</option>
                                <option value="80000">od 80.000 EUR</option>
                                <option value="90000">od 90.000 EUR</option>
                                <option value="100000">od 100.000 EUR</option>
                            </select>

                            <select name="priceTo" id="priceTo" class="custom-select">
                                <option value="999999">Cena do</option>
                                <option value="100">do 100 EUR</option>
                                <option value="500">do 500 EUR</option>
                                <option value="1000">do 1.000 EUR</option>
                                <option value="1500">do 1.500 EUR</option>
                                <option value="2000">do 2.000 EUR</option>
                                <option value="2500">do 2.500 EUR</option>
                                <option value="3000">do 3.000 EUR</option>
                                <option value="3500">do 3.500 EUR</option>
                                <option value="4000">do 4.000 EUR</option>
                                <option value="4500">do 4.500 EUR</option>
                                <option value="5000">do 5.000 EUR</option>
                                <option value="6000">do 6.000 EUR</option>
                                <option value="7000">do 7.000 EUR</option>
                                <option value="8000">do 8.000 EUR</option>
                                <option value="9000">do 9.000 EUR</option>
                                <option value="10000">do 10.000 EUR</option>
                                <option value="11000">do 11.000 EUR</option>
                                <option value="12000">do 12.000 EUR</option>
                                <option value="13000">do 13.000 EUR</option>
                                <option value="14000">do 14.000 EUR</option>
                                <option value="15000">do 15.000 EUR</option>
                                <option value="16000">do 16.000 EUR</option>
                                <option value="17000">do 17.000 EUR</option>
                                <option value="18000">do 18.000 EUR</option>
                                <option value="19000">do 19.000 EUR</option>
                                <option value="20000">do 20.000 EUR</option>
                                <option value="22500">do 22.500 EUR</option>
                                <option value="25000">do 25.000 EUR</option>
                                <option value="27500">do 27.500 EUR</option>
                                <option value="30000">do 30.000 EUR</option>
                                <option value="35000">do 35.000 EUR</option>
                                <option value="40000">do 40.000 EUR</option>
                                <option value="45000">do 45.000 EUR</option>
                                <option value="50000">do 50.000 EUR</option>
                                <option value="60000">do 60.000 EUR</option>
                                <option value="70000">do 70.000 EUR</option>
                                <option value="80000">do 80.000 EUR</option>
                                <option value="90000">do 90.000 EUR</option>
                                <option value="100000">do 100.000 EUR</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 p-0 pt-1 font-weight-normal">
                            <div class="form-check pretty p-icon p-rotate ml-sm-4">
                                <input name="avaliable" class="form-check-input" type="checkbox" value="1" id="avaliable">
                                <div class="state p-danger-o">
                                    <i class="icon fa fa-check"></i>
                                    <label class="form-check-label" for="avaliable">
                                        samo na zalogi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <label for="yearMin" class="col-12 p-0 mt-3 mb-0"><strong>Letnik 1. registracije</strong></label>
                        <div class="col-12 col-sm-8 p-0 pr-3 input-group">
                            <select name="yearMin" id="yearMin" class="custom-select">
                                    <option value="0">Letnik od</option>
                                    <?php 
                            
                            $i = date("Y");

                            while($i > 1974){
                                echo "<option value=".$i.">od ".$i."</option>";
                                $i = $i - 1;
                            }
                            
                            ?>
                            </select>

                            <select name="yearMax" id="yearMax" class="custom-select">
                                    <option value="999999">Letnik do</option>
                                    <?php 
                            
                            $i = date("Y");

                            while($i > 1974){
                                echo "<option value=".$i.">do ".$i."</option>";
                                $i = $i - 1;
                            }
                            
                            ?>
                            </select>
                        </div>

                        <div class="col-6 col-sm-4 p-0 pt-1 font-weight-normal">
                            <div class="form-check pretty p-icon p-rotate ml-sm-4">
                                <input name="oldtimer" class="form-check-input" type="checkbox" value="1" id="oldtimer">
                                <div class="state p-danger-o">
                                    <i class="icon fa fa-check"></i>
                                    <label class="form-check-label" for="oldtimer">
                                        oldtimer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <label for="kmMin" class="col-12 mt-3 p-0 m-0"><strong>Prevoženih km</strong></label>
                        <div class="col-12 col-sm-8 p-0 pr-3 input-group">
                            <select name="kmMin" id="kmMin" class="custom-select">
                                <option value="0">Prevoženi km od</option>
                                <option value="5000">od 5000 km</option>
                                <option value="10000">od 10000 km</option>
                                <option value="20000">od 20000 km</option>
                                <option value="25000">od 25000 km</option>
                                <option value="50000">od 50000 km</option>
                                <option value="75000">od 75000 km</option>
                                <option value="100000">od 100000 km</option>
                                <option value="125000">od 125000 km</option>
                                <option value="150000">od 150000 km</option>
                                <option value="200000">od 200000 km</option>
                                <option value="250000">od 250000 km</option>
                            </select>

                            <select name="kmMax" id="kmMax" class="custom-select">

                                    <option value="9999999">Prevoženi km do</option>
                                    <option value="5000">do 5000 km</option>
                                    <option value="10000">do 10000 km</option>
                                    <option value="20000">do 20000 km</option>
                                    <option value="25000">do 25000 km</option>
                                    <option value="50000">do 50000 km</option>
                                    <option value="75000">do 75000 km</option>
                                    <option value="100000">do 100000 km</option>
                                    <option value="125000">do 125000 km</option>
                                    <option value="150000">do 150000 km</option>
                                    <option value="200000">do 200000 km</option>
                                    <option value="250000">do 250000 km</option>

                            </select>
                        </div>

                        <div class="col-6 col-sm-4 p-0 pt-1 font-weight-normal">
                            <div class="form-check pretty p-icon p-rotate ml-sm-4">
                                <input name="warranty" class="form-check-input" type="checkbox" value="1" id="warranty">
                                <div class="state p-danger-o">
                                    <i class="icon fa fa-check"></i>
                                    <label class="form-check-label" for="warranty">
                                        garancija
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white shadow-box px-3 pt-2 pb-2 mb-2">
                        <div class="col-12 border-bottom p-0 mb-3">
                            <h5><strong>Gorivo, motor, menjalnik</strong></h5>
                        </div>

                        <div class="col-12 col-sm-4 p-0 pr-3">
                            <label for="gearbox" class="m-0"><strong>Menjalnik</strong></label>
                            <select name="gearbox" id="gearbox" class="custom-select">
                                <option value="all">ni pomemben</option>
                                <?php 
                                
                                $query = "SELECT * FROM gearboxes ORDER BY name;";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();

                                while ($row = $stmt->fetch()) {
                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 p-0 pr-3">
                            <label for="fuelType" class="m-0"><strong>Gorivo</strong></label>
                            <select name="fuelType" id="fuelType" class="custom-select">
                                <option value="all">katerokoli</option>
                                <?php 
                                
                                $query = "SELECT * FROM fuel_types ORDER BY name;";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();

                                while ($row = $stmt->fetch()) {
                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                                
                                ?>
                            </select>
                        </div>

                        <label for="ccmMin" class="col-12 p-0 m-0 mt-3"><strong>Prostornina motorja</strong></label>
                        <div class="col-12 col-sm-8 p-0 pr-3 input-group">
                            <select name="ccmMin" id="ccmMin" class="custom-select">
                                <option value="0">od min.</option>
                                <option value="1000">1000 ccm</option>
                                <option value="1350">1350 ccm</option>
                                <option value="1600">1600 ccm</option>
                                <option value="2000">2000 ccm</option>
                                <option value="3000">3000 ccm</option>
                                <option value="4000">4000 ccm</option>
                            </select> 
                            <select name="ccmMax" id="ccmMax" class="custom-select">
                                <option value="999999">do max.</option>
                                <option value="1000">1000 ccm</option>
                                <option value="1350">1350 ccm</option>
                                <option value="1600">1600 ccm</option>
                                <option value="2000">2000 ccm</option>
                                <option value="3000">3000 ccm</option>
                                <option value="4000">4000 ccm</option>
                            </select>
                        </div>

                        <label for="kwMin" class="col-12 p-0 m-0 mt-3"><strong>Moč motorja</strong></label>
                        <div class="col-12 col-sm-8 p-0 pr-3 input-group">
                            <select name="kwMin" id="kwMin" class="custom-select">
                                <option value="0">od min.</option>
                                <option value="44">44 kW (60 KM)</option>
                                <option value="55">55 kW (75 KM)</option>
                                <option value="66">66 kW (90 KM)</option>
                                <option value="74">74 kW (100 KM)</option>
                                <option value="85">85 kW (116 KM)</option>
                                <option value="96">96 kW (130 KM)</option>
                                <option value="110">110 kW (150 KM)</option>
                                <option value="147">147 kW (200 KM)</option>
                                <option value="184">184 kW (250 KM)</option>
                                <option value="220">220 kW (300 KM)</option>
                                <option value="30">30 kW (40 KM)</option>
                                <option value="40">40 kW (54 KM)</option>
                                <option value="50">50 kW (67 KM)</option>
                                <option value="60">60 kW (80 KM)</option>
                                <option value="70">70 kW (94 KM)</option>
                                <option value="80">80 kW (107 KM)</option>
                                <option value="90">90 kW (121 KM)</option>
                                <option value="100">100 kW (134 KM)</option>
                                <option value="110">110 kW (147 KM)</option>
                                <option value="120">120 kW (161 KM)</option>
                                <option value="130">130 kW (174 KM)</option>
                                <option value="150">150 kW (201 KM)</option>
                                <option value="200">200 kW (268 KM)</option>
                                <option value="250">250 kW (335 KM)</option>
                                <option value="300">300 kW (402 KM)</option>
                            </select>
                            <select name="kwMax" id="kwMax" class="custom-select">
                            <option value="999999">do max.</option>
                            <option value="44">44 kW (60 KM)</option>
                            <option value="55">55 kW (75 KM)</option>
                            <option value="66">66 kW (90 KM)</option>
                            <option value="74">74 kW (100 KM)</option>
                            <option value="85">85 kW (116 KM)</option>
                            <option value="96">96 kW (130 KM)</option>
                            <option value="110">110 kW (150 KM)</option>
                            <option value="147">147 kW (200 KM)</option>
                            <option value="184">184 kW (250 KM)</option>
                            <option value="222">222 kW (300 KM)</option>
                            <option value="30">30 kW (40 KM)</option>
                            <option value="40">40 kW (54 KM)</option>
                            <option value="50">50 kW (67 KM)</option>
                            <option value="60">60 kW (80 KM)</option>
                            <option value="70">70 kW (94 KM)</option>
                            <option value="80">80 kW (107 KM)</option>
                            <option value="90">90 kW (121 KM)</option>
                            <option value="100">100 kW (134 KM)</option>
                            <option value="110">110 kW (147 KM)</option>
                            <option value="120">120 kW (161 KM)</option>
                            <option value="130">130 kW (174 KM)</option>
                            <option value="150">150 kW (201 KM)</option>
                            <option value="200">200 kW (268 KM)</option>
                            <option value="250">250 kW (335 KM)</option>
                            <option value="300">300 kW (402 KM)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row bg-white shadow-box px-3 pt-2 pb-2 mb-2">
                        <div class="col-12 border-bottom p-0 mb-3">
                            <h5><strong>Dodatne opcije</strong></h5>
                        </div>
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
                                    <input name="garaged" class="form-check-input" type="checkbox" value="1" id="garaged">
                                    <div class="state p-danger-o">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label" for="garaged">
                                            garažiran
                                        </label>
                                    </div>
                            </div>
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

                    </div>

                    <div class="row bg-white rounded shadow-box px-3 pt-2 pb-3 mb-2">
                        <div class="col-12 border-bottom p-0 mb-3"><h5><strong>Starost oglasa, prodajalec</strong></h5></div>
                        <div class="col-12 col-sm-4 p-0 pr-3">
                            <label for="adAge" class="m-0"><strong>Oglas objavljen</strong></label>
                            <select name="adAge" id="adAge" class="custom-select">
                                <option value="all">kadarkoli</option>
                                <option value="day">danes</option>
                                <option value="week">ta teden</option>
                                <option value="month">ta mesec</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4 p-0 pr-3">
                            <label for="sellerType" class="m-0"><strong>Oglas objavljen</strong></label>
                            <select name="sellerType" id="sellerType" class="custom-select">
                                <option value="all">trgovec ali fizična oseba</option>
                                <?php 
                                
                                $query = "SELECT * FROM account_types WHERE name != 'Admin' ORDER BY name;";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();

                                while ($row = $stmt->fetch()) {
                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }   
                                
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4 p-0 pr-3">
                            <label for="sellerLocation" class="m-0"><strong>Lokacija prodajalca / pošta</strong></label>
                            <select name="sellerLocation" id="sellerLocation" class="custom-select">
                                <option value="all">kjerkoli</option>
                                <option value="1">1000 - LJ z okolico</option>
                                <option value="2">2000 - MB z okolico</option>
                                <option value="3">3000 - CE z okolico</option>
                                <option value="4">4000 - KR z okolico</option>
                                <option value="5">5000 - GO z okolico</option>
                                <option value="6">6000 - KP z okolico</option>
                                <option value="8">8000 - NM z okolico</option>
                                <option value="9">9000 - MS z okolico</option>
                            </select>
                        </div>
                    </div>

                    <div class="row m-0 my-3 p-0">
                        <div class="col-12 p-0">
                            <button type="submit" class="btn btn-lg btn-block orange-bg text-center py-0">
                                <i class="fa fa-search px-2 py-2"></i>
                                <span class="px-3 py-2 float-left">Iskanje vozil</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>