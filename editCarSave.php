<?php

include 'connect.php';
session_start();

if(isset($_POST['id']) && isset($_POST['manufacturer']) && isset($_POST['model']) && isset($_POST['doors']) && isset($_POST['seats']) && isset($_POST['airbags']) && isset($_POST['type']) && isset($_POST['car_type']) && isset($_POST['vehicle_status']) && isset($_POST['manufacture_year']) && isset($_POST['first_registration']) && isset($_POST['inspection_expiry']) && isset($_POST['color']) && isset($_POST['ownership']) && isset($_POST['mileage']) && isset($_POST['comment']) && isset($_POST['fuel']) && isset($_POST['gearbox']) && isset($_POST['power']) && isset($_POST['ccm']) && isset($_POST['consumption']) && isset($_POST['price']) && isset($_SESSION['user_id'])){
    
    $id = $_POST['id'];
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $type = $_POST['type'];
    $car_type = $_POST['car_type'];
    $vehicle_status = $_POST['vehicle_status'];
    $manufacture_year = $_POST['manufacture_year'];
    $first_registration = $_POST['first_registration'];
    $inspection_expiry = $_POST['inspection_expiry'];
    $color = $_POST['color'];
    $ownership = $_POST['ownership'];
    $mileage = $_POST['mileage'];
    $comment = $_POST['comment'];
    $fuel = $_POST['fuel'];
    $gearbox = $_POST['gearbox'];
    $power = $_POST['power'];
    $ccm = $_POST['ccm'];
    $consumption = $_POST['consumption'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id'];
    $doors = $_POST['doors'];
    $seats = $_POST['seats'];
    $airbags = $_POST['airbags'];

    if(isset($_POST['ac'])){
        $ac = 1;
    }
    else{
        $ac = 0;
    }

    if(isset($_POST['digital_ac'])){
        $digital_ac = 1;
    }
    else{
        $digital_ac = 0;
    }
    
    if(isset($_POST['keyless'])){
        $keyless = 1;
    }
    else{
        $keyless = 0;
    }

    if(isset($_POST['headup'])){
        $headup = 1;
    }
    else{
        $headup = 0;
    }

    if(isset($_POST['navigation'])){
        $navigation = 1;
    }
    else{
        $navigation = 0;
    }

    if(isset($_POST['cd_player'])){
        $cd_player = 1;
    }
    else{
        $cd_player = 0;
    }

    if(isset($_POST['mp3_player'])){
        $mp3_player = 1;
    }
    else{
        $mp3_player = 0;
    }

    if(isset($_POST['dab'])){
        $dab = 1;
    }
    else{
        $dab = 0;
    }

    if(isset($_POST['electric_parking_brake'])){
        $electric_parking_brake = 1;
    }
    else{
        $electric_parking_brake = 0;
    }

    if(isset($_POST['abs'])){
        $abs = 1;
    }
    else{
        $abs = 0;
    }

    if(isset($_POST['fourwheel'])){
        $fourwheel = 1;
    }
    else{
        $fourwheel = 0;
    }

    if(isset($_POST['alarm'])){
        $alarm = 1;
    }
    else{
        $alarm = 0;
    }

    if(isset($_POST['xenon'])){
        $xenon = 1;
    }
    else{
        $xenon = 0;
    }

    if(isset($_POST['led'])){
        $led = 1;
    }
    else{
        $led = 0;
    }

    if(isset($_POST['automatic_lights'])){
        $automatic_lights = 1;
    }
    else{
        $automatic_lights = 0;
    }

    if(isset($_POST['emergency_brake'])){
        $emergency_brake = 1;
    }
    else{
        $emergency_brake = 0;
    }

    if(isset($_POST['cruise_control'])){
        $cruise_control = 1;
    }
    else{
        $cruise_control = 0;
    }

    if(isset($_POST['hill_assist'])){
        $hill_assist = 1;
    }
    else{
        $hill_assist = 0;
    }

    if(isset($_POST['pdc'])){
        $pdc = 1;
    }
    else{
        $pdc = 0;
    }

    if(isset($_POST['rear_camera'])){
        $rear_camera = 1;
    }
    else{
        $rear_camera = 0;
    }

    if(isset($_POST['service_book'])){
        $service_book = 1;
    }
    else{
        $service_book = 0;
    }

    if(isset($_POST['slovenian'])){
        $slovenian = 1;
    }
    else{
        $slovenian = 0;
    }

    if(isset($_POST['oldtimer'])){
        $oldtimer = 1;
    }
    else{
        $oldtimer = 0;
    }

    if(isset($_POST['garaged'])){
        $garaged = 1;
    }
    else{
        $garaged = 0;
    }

    if(isset($_POST['cash_discount'])){
        $cash_discount = 1;
    }
    else{
        $cash_discount = 0;
    }

    if(isset($_POST['last_price'])){
        $last_price = 1;
    }
    else{
        $last_price = 0;
    }

    if(isset($_POST['warranty'])){
        $warranty = 1;
    }
    else{
        $warranty = 0;
    }

    if(isset($_POST['guarranty'])){
        $guarranty = 1;
    }
    else{
        $guarranty = 0;
    }

    if(isset($_POST['metallic'])){
        $metallic = 1;
    }
    else{
        $metallic = 0;
    }


    $query = "UPDATE cars SET model_id=?, type=?, car_type_id=?, vehicle_status_id=?, has_warranty=?, has_guarranty=?, oldtimer=?, first_registration=?, manufacture_year=?, inspection_expiry=?,
    mileage=?, number_of_owner_id=?, price=?, cash_discount=?, last_price=?, service_book=?, slovenian=?, garaged=?, fuel_type_id=?, gearbox_id=?, power=?, ccm=?, doors=?, seats=?, color_id=?, metallic=?,
    consumption=?, abs=?, fourwheel=?, airbags=?, xenon=?, led=?, automatic_lights=?, alarm=?, headup=?, emergency_brake=?, ac=?, digital_ac=?, keyless_go=?, cruise_control=?,
    electric_parking_brake=?, cd_player=?, mp3_player=?, dab=?, navigation=?, rear_camera=?, hill_assist=?, pdc=?, comment=?, avaliable=1 WHERE id=?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$model, $type, $car_type, $vehicle_status, $warranty, $guarranty, $oldtimer, $first_registration, $manufacture_year, $inspection_expiry, 
    $mileage, $ownership, $price, $cash_discount, $last_price, $service_book, $slovenian, $garaged, $fuel, $gearbox, $power, $ccm, $doors, $seats, $color, $metallic,
    $consumption, $abs, $fourwheel, $airbags, $xenon, $led, $automatic_lights, $alarm, $headup, $emergency_brake, $ac, $digital_ac, $keyless, $cruise_control, $electric_parking_brake,
    $cd_player, $mp3_player, $dab, $navigation, $rear_camera, $hill_assist, $pdc, $comment, $id]);

    header("Location: ads.php?id=$id");
}
?>