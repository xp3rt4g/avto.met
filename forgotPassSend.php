<?php 

include 'connect.php';
session_start();
$error="";
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
    $_SESSION['err'] = 50;
       }else{
       $query = "SELECT * FROM `users` WHERE email='".$email."'";
       $stmt = $pdo->prepare($query);
       $stmt->execute();
       $row = $stmt->fetch();
       if ($row==""){
       $_SESSION['err'] = 50;
       $error = "prazno";
       }
       if($row['pass'] == 'social'){
           $_SESSION['err'] = 55;
           $error = "fb ali google";
       }
      }
       if($error!=""){
       header("Location: forgotPassEmail.php");
       }else{
       $expFormat = mktime(
       date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
       );
       $expDate = date("Y-m-d H:i:s",$expFormat);
       $key = md5(2418*2+$email);
       $addKey = substr(md5(uniqid(rand(),1)),3,10);
       $key = $key . $addKey;
    // Insert Temp Table
    $query = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
    VALUES ('".$email."', '".$key."', '".$expDate."');";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
     
    $output='<p>Dragi uporabnik,</p>';
    $output.='<p>Kliknite na povezavo, da ponastavite svoje geslo.</p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p><a href="https://www.povse.xyz/resetPassword.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
    https://www.povse.xyz/resetPassword.php?key='.$key.'&email='.$email.'&action=reset</a></p>'; 
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p>Prosim skopirajte celoten url. Povezava bo iz varnostnih razlogov veljavna en dan.</p>';
    $output.='<p>Če niste zahtevali ponastavitve gesla, ne skrbite. Vaše geslo bo ostalo enako.</p>';   
    $output.='<p>Hvala,</p>';
    $output.='<p>avto.met ekipa</p>';
    $body = $output; 
    $subject = "Ponastavitev gesla - avto.met";
     
    $email_to = $email;
    $fromserver = "noreply@povse.xyz"; 
    require("PHPMailer/PHPMailerAutoload.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "mail.povse.xyz"; // Enter your host here
    $mail->SMTPAuth = true;
    $mail->Username = "noreply@povse.xyz"; // Enter your email here
    $mail->Password = "password123.123"; //Enter your password here
    $mail->Port = 25;
    $mail->IsHTML(true);
    $mail->From = "noreply@povse.xyz";
    $mail->FromName = "avto.met";
    $mail->Sender = $fromserver; // indicates ReturnPath header
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($email_to);
    if(!$mail->Send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
    $_SESSION['success'] = 1;
    header("Location: login.php");
     }
       }
    }else{
        header("Location: forgotPassEmail.php");
    }
    ?>