<!DOCTYPE html>
<html lang="en">
<?php
 include_once 'header.php';
?>
<head>
<link rel="stylesheet" href="css/showad.css">
</head>
<body>
<?php

if(isset($_GET['id'])){

    include_once 'connect.php';

    $id_car  = $_GET['id'];

    $query = "SELECT c.*, i.url, t.name AS town, t.post_number, col.name AS color, noo.name AS owner_number, vs.name AS status, ft.name AS fuel, gr.name AS gearbox FROM cars c INNER JOIN number_of_owners noo ON noo.id=c.number_of_owner_id INNER JOIN colors col ON col.id=c.color_id INNER JOIN gearboxes gr ON gr.id=c.gearbox_id INNER JOIN fuel_types ft ON ft.id=c.fuel_type_id INNER JOIN images i ON i.car_id=c.id INNER JOIN vehicle_status vs ON vs.id=c.vehicle_status_id INNER JOIN users us ON us.id=c.user_id INNER JOIN towns t ON t.id=us.town_id WHERE c.id=?";

    $stmt = $pdo->prepare($query);

    $stmt->execute([$id_car]);

    if($stmt->rowCount() != 1){
        header("Location: index.php");
    }
    else{

        $row = $stmt->fetch();

?>

<div class="container p-0">
    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
            <div class="row pt-3 pb-2 px-3">
                <div class="col-12 px-0">
                    <h3><?php echo $row['type'] ?></h3>
                </div>
            </div>
    </div>

    <div class="container">
        <div class="row p-0">
            <div class="col-12 col-lg-8 pr-0 pr-lg-3 pl-0">
                <div class="col-12 bg-white mb-3 p-1 shadow-box rounded">
                    <div class="col-12 p-2">
                        <div class="text-center">
                            <img src="<?php echo $row['url'] ?>" alt="image" border="0" class="img-fluid w-100 mw-100">
                        </div>
                    </div>
                </div>
                <div class="d-block d-lg-none col-12 p-0">
                    <div class="card w-100 mb-3 text-center rounded shadow-box m-0">
                        <div class="card-body p-0">
                            <p class="h2 font-weight-bold align-middle py-4 mb-0"><?php echo number_format($row['price'] , 0, ',', '.') . " €" ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-3 bg-white rounded shadow-box">
                    <table class="table table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" scope="col">Osnovni podatki</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="w-50 border border-white"></th>
                                <td class="w-50 border border-white"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Starost:</th>
                                <td><strong><?php echo $row['status'] ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Prva registracija:</th>
                                <td><strong><?php echo date_format((DateTime::createFromFormat('Y-m-d', $row['first_registration'])), "m / Y"); if($row['slovenian'] == 1){ echo " <img src='img/SLOporeklo.gif' alt='slovenski' align='absmiddle'>"; } ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Leto proizvodnje:</th>
                                <td><strong><?php echo $row['manufacture_year'] ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Prevoženi kilometri:</th>
                                <td><strong><?php echo $row['mileage'] ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Tehnični pregled:</th>
                                <td><strong><?php echo date_format((DateTime::createFromFormat('Y-m-d', $row['inspection_expiry'])), "m / Y") ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Motor:</th>
                                <td><strong><?php echo $row['ccm']." ccm, ".$row['power']." kW (".round(($row['power'] * 1.341), 0)." KM)" ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Gorivo:</th>
                                <td><strong><?php echo $row['fuel'] ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Menjalnik:</th>
                                <td><strong><?php echo $row['gearbox'] ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Število vrat:</th>
                                <td><strong><?php echo $row['doors']." vr." ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Barva:</th>
                                <td><strong><?php echo $row['color'] ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-normal">Kraj ogleda:</th>
                                <td><strong><?php echo $row['post_number']. " - ". $row['town'] ?></strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" scope="col">Poraba goriva in emisije</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th  scope="row" class="w-50 border border-white"></th>
                                <td class="w-50 border border-white"></td>
                            </tr>
                            <tr>
                                <th  scope="row" class="font-weight-normal">Kombinirana vožnja</th>
                                <td><strong><?php echo $row['consumption']." l/100km" ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" scope="col">Oprema in ostali podatki o ponudbi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th  scope="row" class="border border-white"></th>
                                <td class="border border-white"></td>
                            </tr>
                            <tr>
                                <th  scope="row" class="font-weight-bold">Podvozje:</th>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="list font-weight-normal mb-0">
                                        <?php if($row['abs'] == 1){ echo "<li>ABS zavorni sistem</li><li>BAS pomoč pri zaviranju</li>"; } ?>
                                        <?php if($row['fourwheel'] == 1){ echo "<li>Štirikolesni pogon</li><li>Samodejna zapora diferenciala</li>"; } ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                            <th  scope="row" class="font-weight-bold">Varnost:</th>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="list font-weight-normal mb-0">
                                        <li><?php echo $row['airbags'] ?> x zračna vreča / airbag</li>
                                        <li>tretja zavorna luč</li>
                                        <li>kodno varovan vžig motorja</li>
                                        <?php if($row['emergency_brake'] == 1){ echo "<li>zaviranje v sili</li>"; } ?>
                                        <?php if($row['alarm'] == 1){ echo "<li>alarmna naprava</li>"; } ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                            <th  scope="row" class="font-weight-bold">Notranjost:</th>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="list font-weight-normal mb-0">
                                        <li>število sedežev: <?php echo $row['seats'] ?></li>
                                        <li>nastavljivi sedeži</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                            <th  scope="row" class="font-weight-bold">Udobje:</th>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="list font-weight-normal mb-0">
                                        <?php if($row['ac'] == 1){ echo "<li>klimatska naprava</li>"; } ?>
                                        <?php if($row['digital_ac'] == 1){ echo "<li>klimatska naprava: digitalna</li>"; } ?>
                                        <?php if($row['keyless_go'] == 1){ echo "<li>keyless go</li>"; } ?>
                                        <?php if($row['start_stop'] == 1){ echo "<li>start-stop sistem</li>"; } ?>
                                        <?php if($row['cruise_control'] == 1){ echo "<li>tempomat</li>"; } ?>
                                        <?php if($row['electric_parking_brake'] == 1){ echo "<li>električna ročna zavora</li>"; } ?>
                                        <?php if($row['rear_camera'] == 1){ echo "<li>vzvratna kamera</li>"; } ?>
                                        <?php if($row['towing_hook'] == 1){ echo "<li>vlečna kljuka</li>"; } ?>
                                        <?php if($row['hill_assist'] == 1){ echo "<li>pomoč za speljevanje v klancu</li>"; } ?>
                                        <?php if($row['pdc'] == 1){ echo "<li>parkirni senzorji</li>"; } ?>
                                        <?php if($row['headup'] == 1){ echo "<li>headup display</li>"; } ?>
                                        <?php if($row['automatic_lights'] == 1){ echo "<li>avtomatske luči</li>"; } ?>
                                        <?php if($row['xenon'] == 1){ echo "<li>xenon žarometi</li>"; } ?>
                                        <?php if($row['led'] == 1){ echo "<li>led luči</li>"; } ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                            <th  scope="row" class="font-weight-bold">Multimedija:</th>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="list font-weight-normal mb-0">
                                        <?php if($row['cd_player'] == 1){ echo "<li>CD predvajalnik</li>"; } ?>
                                        <?php if($row['mp3_player'] == 1){ echo "<li>MP3 predvajalnik</li>"; } ?>
                                        <?php if($row['usb'] == 1){ echo "<li>USB priklop</li>"; } ?>
                                        <?php if($row['dab'] == 1){ echo "<li>DAB radio</li>"; } ?>
                                        <?php if($row['navigation'] == 1){ echo "<li>navigacija</li>"; } ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                            <th  scope="row" class="font-weight-bold">Stanje:</th>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="list font-weight-normal mb-0">
                                        <?php if($row['service_book'] == 1){ echo "<li>servisna knjiga</li>"; } ?>
                                        <?php if($row['driveable'] == 0){ echo "<li>vozilo NI vozno</li>"; } ?>
                                        <?php if($row['damaged'] == 1){ echo "<li>vozilo je POŠKODOVANO</li>"; } ?>
                                        <?php if($row['crashed'] == 1){ echo "<li>vozilo je KARAMBOLIRANO</li>"; } ?>
                                        <?php if($row['slovenian'] == 1){ echo "<li>slovensko poreklo</li>"; } ?>
                                        <?php if($row['garaged'] == 1){ echo "<li>garažirano</li>"; } ?>
                                        <li><?php echo $row['owner_number'] ?></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-sm">
                    <thead class="thead-light">
                            <tr>
                                <th colspan="2" scope="col">Opis:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-normal border-top p-0 pt-3"><?php echo $row['comment'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 



</div>


<?php     

}

}
else{
    header("Location: index.php");
}

?>

</body>