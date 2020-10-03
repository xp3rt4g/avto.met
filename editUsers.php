<?php 

include_once 'header.php';

?>

<link rel="stylesheet" href="css/edit.css">


<div class="container p-0">
    <div class="row bg-white rounded-bottom shadow-box pt-3 pb-2 m-0 mb-3">
        <div class="col-12">
            <h4>Urejanje uporabnikov</h4>
        </div>
    </div>

    <?php

    if(isset($_SESSION['err'])){

        if($_SESSION['err'] == 10){
            echo "<div class='alert alert-danger' role='alert'>
            Ne morate izbrisati uporabnika, ki ima objavljene oglase!
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
                Email
            </th>
            <th scope="col">
                Naslov
            </th>
            <th scope="col">
                Mesto
            </th>
            <th scope="col">
                Tel. št.
            </th>
            <th scope="col">
                Vrsta računa
            </th>
            <th scope="col">
                Izbriši
            </th>
            <th scope="col">
                Uredi
            </th>
            </tr>
            </thead>

            <tbody>
        
            <?php

            include_once 'connect.php';

            $query = "SELECT u.*, t.name AS town, at.name AS acc_type FROM users u INNER JOIN towns t ON t.id=u.town_id INNER JOIN account_types at ON at.id=u.account_type_id ORDER BY u.name;";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    ?> 

                    <tr>
                    <td>
                    <?php echo $row['name']; ?>
                    </td>
                    <td>
                    <?php echo $row['email']; ?>
                    </td>
                    <td>
                    <?php echo $row['address']; ?>
                    </td>
                    <td>
                    <?php echo $row['town']; ?>
                    </td>
                    <td>
                    <?php echo $row['phone']; ?>
                    </td>
                    <td>
                    <?php echo $row['acc_type']; ?>
                    </td>
                    <td>
                    <a href="deleteUser.php?id=<?php echo $row['id']; ?>"><i class="fa fa-times fa-2x text-danger"></i></a>
                    </td>
                    <td>
                    <a href="editUser.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil fa-2x text-muted"></i></a>
                    </td>
                    </tr>

                    <?php
                }

            ?>
        </tbody>
        </table>


    </div>

</div>