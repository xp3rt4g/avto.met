<?php 

include_once 'header.php';

?>

<link rel="stylesheet" href="css/edit.css">


<div class="container p-0">
    <div class="row bg-white rounded-bottom shadow-box pt-3 pb-2 m-0 mb-3">
        <div class="col-12">
            <h4>Urejanje znamk</h4>
        </div>
    </div>

    <?php

    if(isset($_SESSION['err'])){

        if($_SESSION['err'] == 8){
            echo "<div class='alert alert-danger' role='alert'>
            Preden lahko znamko izbrišete ne sme imeti nobenega modela!
        </div>";
        unset($_SESSION['err']);
        }
    }

    ?>

    <div class="container my-3 pb-2 bg-white shadow-box rounded">

        <table class="table table-striped">

            <thead>
            <tr>
            <th scope="col">
                Ime
            </th>
            <th scope="col">
                Število modelov
            </th>
            <th scope="col">
                Izbriši
            </th>
            </tr>
            </thead>

            <tbody>
        
            <?php

            include_once 'connect.php';

            $query = "SELECT man.*, man.id AS id, COUNT(m.id) AS models FROM manufacturers man LEFT JOIN models m ON man.id=m.manufacturer_id GROUP BY man.name ORDER BY man.name;";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    ?> 

                    <tr>
                    <td>
                    <?php echo $row['name']; ?>
                    </td>
                    <td>
                    <?php echo $row['models']; ?>
                    </td>
                    <td>
                    <a href="deleteManufacturer.php?id=<?php echo $row['id']; ?>"><i class="fa fa-times fa-2x text-danger"></i></a>
                    </td>
                    </tr>

                    <?php
                }

            ?>
        </tbody>
        </table>

        <div class="col-12 col-md-4 m-auto">
                        <div class="input-group h-100">
                    
                        <a href="addManufacturer.php" class="btn btn-block h-100 text-center orange-bg text-center py-0">
                            <i class="fa fa-plus px-2"></i>
                            <span class="px-3 text-truncate">Dodaj znamko</span>
                        </a>
                        </div>
                    
                    </div>

    </div>

</div>