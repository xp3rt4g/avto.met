<!DOCTYPE html>
<html lang="en">
<?php
 include_once 'header.php';
?>

<link rel="stylesheet" href="css/search.css">

<body>
<div class="container p-0">
<div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
        <div class="row pt-3 pb-2 px-3">
            <div class="col-12 px-0">
                <h3 class="blue"><strong>Rezultati iskanja</strong></h3>
            </div>
        </div>
    </div>
<?php 

    include 'connect.php';

    if(isset($_GET['search_type'])){
        $search_type = $_GET['search_type'];

        if($search_type == "simple"){
    
            if(isset($_GET['manufacturer']) && isset($_GET['model']) && isset($_GET['priceFrom']) && isset($_GET['priceTo']) && isset($_GET['yearMin']) && isset($_GET['yearMax']) && isset($_GET['kmMax']) && isset($_GET['fuelType'])){
                
                $manufacturer_id = $_GET['manufacturer'];
                $model_id = $_GET['model'];
                $priceFrom = $_GET['priceFrom'];
                $priceTo = $_GET['priceTo'];
                $yearMin = $_GET['yearMin'];
                $yearMax = $_GET['yearMax'];
                $kmMax = $_GET['kmMax'];
                $fuel_type_id = $_GET['fuelType'];


                include_once 'connect.php';

                $query = "SELECT c.*, m.name AS model, man.name AS manufacturer, ft.name AS fueltype, g.name AS gearbox, i.url AS url FROM cars c INNER JOIN fuel_types ft ON ft.id=c.fuel_type_id INNER JOIN gearboxes g ON g.id = c.gearbox_id INNER JOIN models m ON m.id=c.model_id INNER JOIN manufacturers man ON man.id=m.manufacturer_id INNER JOIN images i ON i.car_id=c.id  WHERE c.mileage <= $kmMax AND c.manufacture_year >= $yearMin 
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

            }
            }
            elseif($search_type == "advanced"){
                if(isset($_GET['manufacturer']) && isset($_GET['model']) && isset($_GET['priceFrom']) && isset($_GET['priceTo']) && isset($_GET['yearMin']) && isset($_GET['yearMax']) && isset($_GET['kmMin']) && isset($_GET['kmMax']) && isset($_GET['gearbox']) && isset($_GET['fuelType'])  && isset($_GET['ccmMin'])  && isset($_GET['ccmMax'])  && isset($_GET['kwMin'])  && isset($_GET['kwMax']) && isset($_GET['adAge'])  && isset($_GET['sellerType']) && isset($_GET['sellerLocation'])){
    
                    $manufacturer_id = $_GET['manufacturer']; #
                    $model_id = $_GET['model']; # 
                    $priceFrom = $_GET['priceFrom']; #
                    $priceTo = $_GET['priceTo']; #
                    $yearMin = $_GET['yearMin']; #
                    $yearMax = $_GET['yearMax']; #
                    $kmMin = $_GET['kmMin']; #
                    $kmMax = $_GET['kmMax']; #
                    $gearbox_id = $_GET['gearbox'];#
                    $fuel_type_id = $_GET['fuelType']; #
                    $ccmMin = $_GET['ccmMin']; #
                    $ccmMax = $_GET['ccmMax']; #
                    $kwMin = $_GET['kwMin']; #
                    $kwMax = $_GET['kwMax']; #
                    $adAge = $_GET['adAge']; #
                    $sellerType = $_GET['sellerType']; #
                    $sellerLocation = $_GET['sellerLocation']; #
    
    
                    $query = "SELECT c.*, m.name AS model, man.name AS manufacturer, ft.name AS fueltype, g.name AS gearbox, i.url AS url FROM cars c INNER JOIN vehicle_status vs ON vs.id=c.vehicle_status_id INNER JOIN fuel_types ft 
                    ON ft.id=c.fuel_type_id INNER JOIN gearboxes g ON g.id = c.gearbox_id INNER JOIN models m ON m.id=c.model_id INNER JOIN manufacturers man ON 
                    man.id=m.manufacturer_id INNER JOIN images i ON i.car_id=c.id INNER JOIN users us ON us.id=c.user_id INNER JOIN towns tow ON tow.id=us.town_id 
                    WHERE c.price < $priceTo AND c.price > $priceFrom 
                    AND c.manufacture_year < $yearMax AND c.manufacture_year > $yearMin AND c.mileage < $kmMax AND c.mileage > $kmMin AND c.ccm < $ccmMax AND c.ccm > $ccmMin 
                    AND c.power < $kwMax AND c.power > $kwMin";
    
                    if($gearbox_id != "all"){
                        $query .= " AND c.gearbox_id = $gearbox_id";
                    }
                    if($fuel_type_id != "all"){
                        $query .= " AND c.fuel_type_id = $fuel_type_id";
                    }
                    if($sellerType != "all"){
                        $query .= " AND us.account_type_id = $sellerType";
                    }
                    if($sellerLocation != "all"){
                        $query .= " AND tow.post_number IN '$sellerLocation%'";
                    }
                    if($model_id != "all"){
                        $query .= " AND m.id = $model_id";
                    }
                    if($manufacturer_id != "all"){
                        $query .= "AND m.manufacturer_id = $manufacturer_id";
                    }
                    if($adAge != "all"){
                        if($adAge == "day")
                            $query .= " AND c.date_posted>='".date('Y-m-d')."'";
                        elseif($adAge == "week"){
                            $day = date('w');
                            $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
                            $query .= " AND c.date_posted>='$week_start'";
                        }
                        elseif($adAge == "month"){
                            $days = date('d');
                            $days = $days - 1;
                            $month_start = date('Y-m-d', strtotime('-'.$days.' days'));
                            $query .= " AND c.date_posted>='$month_start'";
                        }
                    }

                    if(isset($_GET['novo']) && isset($_GET['testno']) && isset($_GET['rabljeno'])){

                    }
                    elseif(isset($_GET['novo']) && isset($_GET['testno'])){
                        $query .= " AND vs.name != 'Rabljen'";
                    }
                    elseif(isset($_GET['novo']) && isset($_GET['rabljeno'])){
                        $query .= " AND vs.name != 'Testni'";
                    }
                    elseif(isset($_GET['testno']) && isset($_GET['rabljeno'])){
                        $query .= " AND vs.name != 'Nov'";
                    }
                    elseif(isset($_GET['novo'])){
                        $query .= " AND vs.name = 'Nov'";
                    }
                    elseif(isset($_GET['rabljeno'])){
                        $query .= " AND vs.name = 'Rabljen'";
                    }
                    elseif(isset($_GET['testno'])){
                        $query .= " AND vs.name = 'Testni'";
                    }

                    if(isset($_GET['car_type'])){
                        $car_type = $_GET['car_type'];
                        if($car_type != 'all'){
                            $query .= " AND c.car_type_id = $car_type";
                        }
                    }
                    
                    
                    $query .= " ORDER BY c.date_posted;";
                    echo $query;
                }
                else{
                    header("Location: car_search.php");
        }
            ?>
            

            <div class="col-12">



            

            <?php

            $stmt = $pdo->prepare($query);
            $stmt->execute();

            if($stmt->rowCount() == 0){
                echo "Žal ni rezultatov za vaše kriterije!";
            }
            else{

            

            while ($row = $stmt->fetch()) {
                ?> 
                
                <div class="row bg-white mb-3 pb-3 pb-sm-0 position-relative results-row center shadow-dark">

                    <a href="ads.php?id=<?php echo $row['id'] ?>" class="stretched-link"></a>

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
    }
    else{
        header("Location: index.php");
    }

?>

</div>
</div>
</body>
</html>
