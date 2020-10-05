<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
  window.onload = myFunction();
  function myFunction() {
    gapi.auth2.getAuthInstance().disconnect()
    });

}
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
<?php 
session_start();

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_type']);

header("Location: index.php");
?>