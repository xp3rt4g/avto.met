<link rel="stylesheet" href="css/login.css">
<?php
include_once 'header.php';
include 'connect.php';

if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");

    $query =  "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $stmt->fetch();

    if($stmt->rowCount() == 0){
    $error .= '<div class="alert alert-danger" role="alert">
    Napačen URL. Preverite, če ste skopirali cel URL!
</div>';
 }else{
  $row = $stmt->fetch();
  $expDate = $row['expDate'];
  if ($expDate <= $curDate){
  ?>
  <br />
  <form method="post" action="" name="update">
  <input type="hidden" name="action" value="update" />
  <br /><br />
  <label><strong>Enter New Password:</strong></label><br />
  <input type="password" name="pass1" maxlength="15" required />
  <br /><br />
  <label><strong>Re-Enter New Password:</strong></label><br />
  <input type="password" name="pass2" maxlength="15" required/>
  <br /><br />
  <input type="hidden" name="email" value="<?php echo $email;?>"/>
  <input type="submit" value="Reset Password" />
  </form>
<?php
}else{
$error .= '<div class="alert alert-danger" role="alert">
Povezava za ponastavitev gesla je žal potekla!
</div>';
            }
      }
if($error!=""){
  echo "<div class='error'>".$error."</div><br />";
  } 
} // isset email key validate end
 
 
if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
$error="";
$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
$error.= '<div class="alert alert-danger" role="alert">
Gesli se ne ujemata!
</div>';
  }
  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{
$pass1 = password_hash($pass1, PASSWORD_DEFAULT);

$query = "UPDATE `users` SET `pass`=? WHERE `email`=?;";

$stmt = $pdo->prepare($query);
$stmt->execute([$pass1, $email]);

$query = "DELETE FROM `password_reset_temp` WHERE `email`= ?;";

$stmt = $pdo->prepare($query);
$stmt->execute([$email]);
 
$_SESSION['success'] = 60;
header("Location: login.php");
   } 
}
?>