<?php 

    include 'header.php';

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_type'])){
        echo "<script> location.href='homepage.php'; </script>";
    }
    else{
?>
<link rel="stylesheet" href="css/login.css">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="1007474745237-2i1sbckbk1m0j1e4diaspqj19no1fjtk.apps.googleusercontent.com">

<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/sl_SI/sdk.js#xfbml=1&version=v8.0&appId=372681983770383&autoLogAppEvents=1" nonce="kx4dPhqB"></script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '372681983770383',
      cookie     : true,
      xfbml      : true,
      version    : 'v8.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


   
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
    console.log(response.authResponse.accessToken);
    FB.api('/me', { locale: 'si_SI', fields: 'name, email,birthday, hometown,education,gender,website,work' },
          function(response) {
            console.log(response.email);
            console.log(response.name);
          }
        );
  }
  });
}
</script>


<div class="container p-0">
    <div class="container bg-white rounded-bottom shadow-box m-0 mb-3">
            <div class="row pt-3 pb-2 px-3">
                <div class="col-12 px-0">
                    <h3><strong>Dobrodošli na moj.avto.met</strong></h3>
                </div>
            </div>
    </div>
    <?php

    if(isset($_SESSION['successRegister'])){
        $success = $_SESSION['successRegister'];

        if($success == 1){
            echo "<div class='alert alert-success' role='alert'>
                Uspešno ste se registrirali na avto.met. Lahko nadaljujete s prijavo!
            </div>";
            $success = NULL;
            $_SESSION['successRegister'] = NULL;
        }
    }

    ?>
    <div class="card-deck">

    <form action="loginProcess.php" method="post">

        <div class="card rounded shadow-box">

            <div class="card-header h4 font-size-l">Prijava v avto.met</div>
            <div class="card-body">
                <label for="email" class="font-weight-bold">E-mail:</label>
                <div class="input-group mb-2 mr-sm-2 mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                    </div>
                    <input type="email" name="email" id="email" placeholder="Vpišite E-mail!" class="form-control form-control-lg" required>

                </div>

                <label for="password" class="w-100 font-weight-bold">
                    <div class="row">
                        <div class="col-6">Geslo:</div>
                        <div class="col-6 text-right">
                            <div class="pretty p-switch p-slim">
                                <input type="checkbox" name="showpass" id="showpass" onclick="showPass()">
                                <div class="state">
                                    <label> Prikaži geslo</label>
                                </div>
                            </div>

                            <!-- 

                            <div class="pretty p-icon p-toggle p-plain">
                                <input type="checkbox" name="showpass" id="showpass" onclick="showPass()">
                                <div class="state p-success-o p-on">
                                    <i class="icon fa fa-eye"></i>
                                    <label>Skrij geslo</label>
                                </div>
                                <div class="state p-off">
                                    <i class="icon fa fa-eye-slash"></i>
                                    <label>Pokaži geslo</label>
                                </div>
                            </div>

                            -->
                        </div>
                    </div>
                </label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-lock fa-2x"></i>
                        </div>
                    </div>
                    <input type="password" name="password" id="password" placeholder="Vpišite geslo!" class="form-control form-control-lg" required>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0 text-center">
            
                <button type="submit" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3">
                    <i class="fa fa-user px-2 py-2"></i>
                    <span class="px-3 py-2 float-left">Prijava</span>
                </button>
                
                <div class="row">
                
                

                <div class="g-signin2 col-5" data-onsuccess="onSignIn"></div>

                
                <div class="fb-login-button col-7" data-size="medium" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width="">
<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button></div>

                </div> 
                
                <a href="forgottenPassword.php">
                    <span class="black">
                        Pozabljeno geslo?
                    </span>
                </a>
            
            </div>

        </div>

    </form>

    <div class="card rounded shadow-box">

        <div class="card-header h4">Registracija na avto.met</div>
        <div class="card-body font-weight-normal">
            Kaj pridobite z registracijo:
            <ul>
                <li>objavljanje oglasov kot POSAMEZNIK</li>
                <li>objavljanje večih oglasov kot TRGOVEC</li>
                <li>shranjevanje priljubljenih kriterijev iskanja</li>
                <li>shranjevanje priljubljenih avtomobilov</li>
            </ul>
            Število objav je lahko omejeno odvisno od tipa registracije in naročniškega razmerja!
        </div>
        <div class="card-footer bg-white border-top-0 text-center">
        
            <a href="registerSelect.php" class="btn btn-lg btn-block orange-bg text-center py-0 mb-3">
                <i class="fa fa-pencil text-white px-2 py-2"></i>
                <span class="text-white font-weight-bold px-3 py-2 float-left">Registriraj se!</span>
            </a>
            <a href="#"><span class="invisible">.</span></a>
        
        </div>
    </div>


    </div>
</div>

<script>

function showPass() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

</script>
</body>
<?php } include_once 'footer.php'; ?>
