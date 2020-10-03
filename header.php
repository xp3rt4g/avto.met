<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avto.met</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="container-fluid headerwrapper p-sm-0 p-1">
    <div class="row m-0">
    	<div class="container headermid">
              <div class="row">
                  
                  <div class="col-4 pl-0">
                    <a target="_self" href="index.php">
                    <img name="Avto.net" src="img/logo.png" alt="www.avto.met" class="logo"/>                            </a>
                   </div>

                    <div class="col-8 d-lg-none d-block moj-menu p-0 m-0 text-right">
                        
                      <button class="navbar-toggler first-button border-0" onclick="changeClass()" type="button" data-toggle="offcanvas">
                          <div class="animated-icon1">
                              <span></span><span></span><span></span>
                            </div>
                      </button>
                    </div>
                    <div class="d-none d-lg-block col-8 moj-menu p-0 m-0">
                    <ul>
                    <?php if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_type'])){ ?>
                      <div class="loggedin">
                      <li class="uporabnik rounded-bottom">
                        <a href="homepage.php"><span>Prijavljeni ste kot: <strong><?php echo $_SESSION['user_name'] ?></strong></span></a>
                        <a href="logout.php"><span>Kliknite <strong>TUKAJ</strong> za odjavo</span></a>
                      </li>
                      </div>
                    <?php }

                    else{ ?>
                      
                      <li>
                         <a href="login.php">
                          <span class="moj-menu-dark mx-1 px-2">
                          <i class="fa fa-user mx-1"></i>
                          moj.avto.met
                          </span>
                          </a>
                      </li>
                      <?php } ?>
                    </ul>                
                    </div>
                </div>
		</div>
	</div>
    <div class="d-none d-lg-block ddcolortabsFULLWIDTH">
        <div id="droplinemenu" class="ddcolortabs">
            <ul class="p-0 m-0">
            <li><a href="index.php" rel="submenuHOME" class="first"><span class="first"><i class="fa fa-home fa-lg"></i></span></a></li>
            <li><a href="car_search.php" rel="submenuAVTO"><span>Išči avte</span></a></li>
            <?php if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_type'])){ ?>
              <li class="float-right"><a href="logout.php"><span>Odjava</span></a></li>
              <li class="float-right"><a href="add_ad.php"><span>Objavi oglas</span></a></li>
              <li class="float-right"><a href="homepage.php"><span>moj.avto.met</span></a></li>
            <?php 
          if($_SESSION['user_type'] == 'Admin'){
            ?> <li class="float-right"><a href="admin.php"><span>Admin</span></a></li> <?php
          }
          } ?>
            </ul>
        </div>
       </div>
</div>

    
</div>

<div class="d-lg-none container-fluid offcanvas-collapse" id="hiddenHamburger">
    <strong>
      <?php if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_type'])){ ?>

        <div class="row">
          <div class="col-12 mt-2">
            <a href="homepage.php" class="h6 black"><span>Prijavljeni ste kot: <strong><?php echo $_SESSION['user_name'] ?></strong></span></a>          </div>
          <div class="col-12 mt-2">
            <a href="homepage.php" class="btn btn-lg btn-block orange-bg text-white font-weight-bold"><i class="fa fa-user"></i><span class="float-left pl-3">Domov</span></a>
          </div>
          <div class="col-6 mt-2 pr-1 h-25">
            <a href="add_ad.php" class="btn btn-lg btn-block orange-bg text-white font-weight-bold"><i class="fa fa-plus-circle"></i><span class="float-left pl-3">Nov oglas</span></a>
          </div>
          <div class="col-6 mt-2 pl-1 h-25">
            <a href="logout.php" class="btn btn-lg btn-block orange-bg text-white font-weight-bold"><i class="fa fa-sign-out"></i><span class="float-left pl-3">Odjava</span></a>
          </div>
        </div>

     <?php }
      else{ ?>
      <div class="row">
          <div class="col-12 mt-2">
              <a href="homepage.php" class="btn btn-lg btn-block orange-bg text-white font-weight-bold"><i class="fa fa-user"></i><span class="float-left pl-3">Prijava v moj.avto.met</span></a>
          </div>
      </div>
      <?php } ?>
    </strong>
</div>
</body>
</html>
<script>
  function changeClass(){
    document.getElementById("hiddenHamburger").classList.toggle('open');
  }
</script>