<?php

include_once 'header.php';

?>

<link rel="stylesheet" href="css/edit.css">

<div class="container p-0">
    <div class="row bg-white rounded-bottom shadow-box pt-3 pb-2 m-0 mb-3">
        <div class="col-12">
            <h4>Dodajanje barve</h4>
        </div>
    </div>


    <div class="card shadow-box">
    
    <form action="addColorProcess.php" method="post">
    
        <div class="card-body">
        
            <h4>Barva</h4>
            <hr>
            <div class="form-group row">
                <label for="name" class="text-muted col-sm-2 col-form-label">Ime:</label>
                <input type="text" name="name" id="name" maxlength="30" class="form-control col-sm-10" required>
            </div>
           
            <div class="col-md-4 col-12 m-auto text-center">

            <button type="submit" class="btn btn-lg btn-block orange-bg text-center py-0 m-auto">
                    <span class="px-3 py-2">Dodaj barvo</span>
            </button>

            </div>

        </div>
    </form>
    </div>
</div>
