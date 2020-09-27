<!DOCTYPE html>
<html lang="en">
<?php
 include_once 'header.php';
?>

<link rel="stylesheet" href="css/search.css">

<body>
<div class="container p-2">
<?php 

    include 'connect.php';

    if(isset($_POST['search_type'])){
        $search_type = $_POST['search_type'];
    

        if(isset($_POST['manufacturer']) && isset($_POST['model']) && isset($_POST['priceFrom']) && isset($_POST['priceTo']) && isset($_POST['yearMin']) && isset($_POST['yearMax']) && isset($_POST['kmMax']) && isset($_POST['fuelType'])){

            $manufacturer_id = $_POST['manufacturer'];
            $model_id = $_POST['model'];
            $priceFrom = $_POST['priceFrom'];
            $priceTo = $_POST['priceTo'];
            $yearMin = $_POST['yearMin'];
            $yearMax = $_POST['yearMax'];
            $kmMax = $_POST['kmMax'];
            $fuel_type_id = $_POST['fuelType'];


            include_once 'connect.php';

            $query = "SELECT c.*, m.name AS model, man.name AS manufacturer, ft.name AS fueltype, g.name AS gearbox, i.url AS url FROM cars c INNER JOIN fuel_types ft ON ft.id=c.fuel_type_id INNER JOIN gearboxes g ON g.id = c.gearbox_id INNER JOIN models m ON m.id=c.model_id INNER JOIN manufacturers man ON man.id=m.manufacturer_id INNER JOIN cars_images ci ON c.id=ci.car_id INNER JOIN images i ON i.id=ci.image_id  WHERE c.mileage <= $kmMax AND c.manufacture_year >= $yearMin 
            AND c.manufacture_year <= $yearMax AND c.price <= $priceTo AND c.price >= $priceFrom ";
            
            if($model_id != "all")
            {
                $query .= "AND m.id = $model_id ";
            } 
            elseif($manufacturer_id != "all")
            { 
                $query .= "AND m.manufacturer_id = $manufacturer_id " ;
            };

            if($fuel_type_id != "all"){
                $query .= "AND c.fuel_type_id = $fuel_type_id ";
            }

            $query .= "ORDER BY c.date_posted;";


            ?>

            <div class="col-12">



            

            <?php
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                ?> 
                
                <div class="row bg-white mb-3 pb-3 pb-sm-0 position-relative results-row center shadow-dark">

                    <a href="ads?id=<?php echo $row['id'] ?>" class="stretched-link"></a>

                    <div class ="bg-dark px-3 py-2 font-weight-bold text-truncate text-white text-decoration-none results-title"><?php echo $row['type'] ?></div>

                    <div class="col-auto px-3 py-0 py-sm-3 pt-3 photo d-flex justify-content-center align-items-center">
                    
                        <div class="photo-display align-self-center">
                        
                            <img src="<?php echo $row['url'] ?>" alt="<?php echo $row['type']; ?>" class="img-fluid">

                        </div>

                    </div>

                    <div class="col-auto py-0 results-top-data pb-lg-3 mt-0 mt-sm-3 mr-0 pr-0">
                    
                        <div class="p-0 m-0 pl-3 pr-3">
                        
                            <div class="results-top-data-display">
                            
                                <table class="table table-striped table-sm table-borderless font-weight-normal  my-3 my-sm-0">
                                
                                    <tbody>
                                    
                                        <tr>
                                        
                                            <td class="w-25 d-none d-md-block pl-3">1.registracija</td>
                                            <td class="w-75 pl-3"><?php echo date("Y", strtotime($row['first_registration'])) ?></td>
                                        
                                        </tr>
                                        <tr>
                                        
                                            <td class="d-none d-md-block pl-3">Prevoženih</td>
                                            <td class="pl-3"><?php echo $row['mileage'] ?> km</td>
                                        
                                        </tr>
                                        <tr>
                                        
                                            <td class="d-none d-md-block pl-3">Gorivo</td>
                                            <td class="pl-3"><?php echo $row['fueltype'] ?></td>
                                        
                                        </tr>
                                        <tr>
                                        
                                            <td class="d-none d-md-block pl-3">Menjalnik</td>
                                            <td class="pl-3"><?php echo $row['gearbox'] ?></td>
                                        
                                        </tr>
                                        <tr class="d-none d-md-table-row">
                                        
                                            <td class="d-none d-md-block pl-3">Motor</td>
                                            <td class="pl-3"><?php echo $row['ccm']."ccm, ".$row['power']."kW / ".round(($row['power'] * 1.341), 0)." KM" ?></td>
                                        
                                        </tr>
                                    
                                    </tbody>
                                
                                </table>
                            
                            </div>
                        
                        </div>

                        <div class="mt-5 mt-sm-0 pt-0 pt-sm-5 results-price-logo">
                    

                            <div class="results-price ml-4 ml-sm-0 ml-md-4">

                                <div class="price-show">
                                
                                    <div class="price-text">
                                    
                                    <?php echo number_format($row['price'] , 0, ',', '.') . " €"; ?>

                                    </div>
                                
                                </div>
                            
                            </div>
                        
                        </div>
                    
                    </div>

                </div>
                
                <?php
            }

            
                        
        }
    }

?>

</div>
</div>
</body>
</html>