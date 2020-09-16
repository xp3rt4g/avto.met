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
                    <select name="manufacturer" id="manufacturer" class="custom-select">
                        <?php 
                        
                            include_once 'connect.php';

                            $query = "SELECT * FROM manufacturers;";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();

                            while ($row = $stmt->fetch()) {
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            }
                        
                        ?>
                    </select>
                </div>
                <div class="col-12 px-0">
                        <select name="model" id="model" class="custom-select">
                        <?php 
                        
                            include_once 'connect.php';

                            $query = "SELECT * FROM models WHERE manufacturer_id = (SELECT MIN(id) FROM manufacturers);";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            echo '<option value="all">Vsi modeli</option>';
                            while ($row = $stmt->fetch()) {
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            }
                        
                        ?>
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
    </div>
    </form>
</div>
    
</body>

<?php 

include_once './footer.php';

?>