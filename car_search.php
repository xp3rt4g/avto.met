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
                        <?php 
                        
                        $query = "SELECT * FROM car_types";

                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        while ($row = $stmt->fetch()){ ?>

                        <div class="col-12 col-sm-4 p-0 font-weight-normal">
                            <div class="form-check pretty p-icon p-rotate mb-4">
                                <input name="<?php echo $row['name'] ?>" class="form-check-input" type="checkbox" value="<?php echo $row['id'] ?>" id="novo">
                                <div class="state p-danger-o">
                                <i class="icon fa fa-check"></i>
                                <label class="form-check-label" for="novo">
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
                </form>
            </div>
        </div>
    </div>
</div>