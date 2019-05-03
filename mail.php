<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


    //you need the php mailer file to require and use 
    if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['number']) && isset($_POST['adress']) && isset($_POST['provider'])){
        $error = "";
        $succes = "";
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $to = strip_tags($_POST['email']);
        }else{
            $error = "Veuillez entrer une adresse courriel valide";
        }    
        $name = strip_tags($_POST['name']);
        $adress = strip_tags($_POST['adress']);
        $provider = strip_tags($_POST['provider']);
        $number = strip_tags($_POST['number']);
        $service = array();
        if(isset($_POST['internet'])){
            $service['internet'] = $_POST['internet'];
        }
        if(isset($_POST['phone'])){
            $service['phone'] = $_POST['phone'];
        }
        if(isset($_POST['television'])){
            $service['television'] = $_POST['television'];
        }
        $service_msg = "Demande pour ce ou ces service(s): ";
        if(!empty($service)){
            foreach($service as $s) {
                if(($s !== "") && ($s !== 'null')){
                    $service_msg .= " " . $s;
                }
            }
        }
    }
    $email_from = 'info@fibrile.ca';
    $email_subject = "Restez connecté - Fibrile";
    $mail = new PHPMailer;
    $email_body = "Nom: " . $name . " Email: " . $to . " Adresse: " . $adress . " Fournisseur: " . $provider . " Numéro de téléphone: " . $number . " " . $service_msg;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($to, $name);
    $mail->addAddress($email_from, 'Fibrile Télécom');
    $mail->Subject  = 'Restez connecté - Fibrile';
    $mail->Body     = $email_body;

    if(!$mail->send()) {
        $succes = "Message envoyé";
        header('Location: index.html');
    } else {
        header('Location: index.html');
    }

?>
