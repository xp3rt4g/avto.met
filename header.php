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

<div class="container-fluid headerwrapper p-0">
    <div class="row m-0">
    	<div class="container headermid">
              <div class="row">
                  
                  <div class="col-4 pl-0">
                    <a target="_self" href="index.php">
                    <img name="Avto.net" src="img/logo.png" alt="www.avto.met" class="logo"/>                            </a>
                   </div>

                    <div class="col-8 d-md-none moj-menu p-0 m-0 text-right">
                        
                      <button class="navbar-toggler first-button border-0" type="button" data-toggle="offcanvas">
                          <div class="animated-icon1">
                              <span></span><span></span><span></span>
                            </div>
                      </button>
                    </div>
                    <div class="d-none d-md-block col-8 moj-menu p-0 m-0">
                    <ul>
                      <li>
                         <a target="_blank" href="add_ad.php">
                          <span class="moj-menu-hover mx-1 px-1">
                          <i class="fa fa-plus-circle mx-1"></i>
                          Objavi oglas
                          </span>
                          </a>
                      </li>
                      <li>
                         <a href="parked.php" target="_blank">
                          <span class="moj-menu-hover mx-1 px-1">
                          <i class="fa fa-star mx-1"></i>
                          Parkirano
                          </span>
                        </a>
                      </li>
                      <li>
                         <a href="login.php" target="_blank">
                          <span class="moj-menu-dark mx-1 px-2">
                          <i class="fa fa-user mx-1"></i>
                          moj.avto.met
                          </span>
                          </a>
                      </li>
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
            </ul>
        </div>
       </div>
</div>

    
</div>
</body>
</html>