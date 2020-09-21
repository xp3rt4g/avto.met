<?php 

include_once './header.php';

?>

<body class="h1">

<div class="container p-0">
    <div class="container m-0 bg-white">
        <div class="row">
            <div class="col mt-3">
                <h4>
                    Iskanje vozil!
                </h4>
            </div>
        </div>
    <form action="search.php" method="post">
        <div class="form-row">
            <div class="col-md-4">
                <div class="col-12 px-0 py-2">
                    <div class="input-group">
                    
                    <select name="manufacturer" id="manufacturer" class="custom-select">
                        <option value="all">Vse znamke</option>
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
                </div>
                <div class="col-12 px-0">
                    <div class="input-group">
                    
                        <select name="model" id="model" class="custom-select">
                        <option value="all">Vsi modeli</option>
                        <script type="text/javascript">
                        $(document).ready(function(e) {
                            $('#manufacturer').change(function(e) { // When the select is changed
                                var sel_value=$(this).val(); // Get the chosen value
                                $.ajax(
                                {
                                    type: "POST",
                                    url: "ajax_load_models.php", // The new PHP page which will get the option value, process it and return the possible options for second select
                                    data: {selected_option: sel_value}, // Send the slected option to the PHP page
                                    dataType:"HTML",
                                    success: function(data)
                                    {

                                        $('#model').find('option').remove().end().append(data); // Append the possible values to the second select
                                    }
                                });
                            });
                        });
                        </script>

                        </select>

                    </div>
                </div>
            </div>

            <div class="col-md-4">

                <div class="col-12 px-0 py-2">
                    <div class="input-group">
                        
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
                </div>

                <div class="col-12 px-0 py-0">
                    <div class="input-group">
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
                            <option value="0">Letnik do</option>
                            <?php 
                            
                            $i = date("Y");

                            while($i > 1974){
                                echo "<option value=".$i.">do ".$i."</option>";
                                $i = $i - 1;
                            }
                            
                            ?>
                        </select>
                    </div>
                </div>
            
            </div>

        <div class="col-md-4">
            
            
        </div>
    </div>
    </form>
</div>
    
</body>

<?php 

include_once './footer.php';

?>