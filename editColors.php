<?php 

include_once 'header.php';

if($_SESSION['user_type'] == 'Admin'){
?>

<link rel="stylesheet" href="css/edit.css">


<div class="container p-0">
    <div class="row bg-white rounded-bottom shadow-box pt-3 pb-2 m-0 mb-3">
        <div class="col-12">
            <h4>Urejanje barv</h4>
        </div>
    </div>

    <?php

    if(isset($_SESSION['err'])){

        if($_SESSION['err'] == 11){
            echo "<div class='alert alert-danger' role='alert'>
            Ne morate izbrisati barve, ki jo uporablja katerikoli oglas!
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
                Izbriši
            </th>
            </tr>
            </thead>

            <tbody>
        
            <?php

            include_once 'connect.php';

            $query = "SELECT * FROM colors ORDER BY name;";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    ?> 

                    <tr>
                    <td>
                    <?php echo $row['name']; ?>
                    </td>
                    <td>
                    <a href="deleteColor.php?id=<?php echo $row['id']; ?>"><i class="fa fa-times fa-2x text-danger"></i></a>
                    </td>
                    </tr>

                    <?php
                }

            ?>
        </tbody>
        </table>

        <div class="col-12 col-md-4 m-auto">
                        <div class="input-group h-100">
                    
                        <a href="addColor.php" class="btn btn-block h-100 text-center orange-bg text-center py-0">
                            <i class="fa fa-plus px-2"></i>
                            <span class="px-3 text-truncate">Dodaj barvo</span>
                        </a>
                        </div>
                    
                    </div>

    </div>

</div>
<?php 

}
else{
    header("Location: index.php");
}
?>