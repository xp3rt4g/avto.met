<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

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


            echo $manufacturer_id;
            echo " - ";
            echo $model_id;
            echo " - "; 
            echo $priceFrom;
            echo " - ";
            echo $priceTo;
            echo " - ";
            echo $yearMin;
            echo " - ";
            echo $yearMax;
            echo " - ";
            echo $kmMax;
            echo " - ";
            echo $fuel_type_id;
        }
    }

?>

</body>
</html>
