<?php
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './config/key.php';

try {
    $data = array();
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->Host = MAIL_HOST;               //Adresse IP ou DNS du serveur SMTP
    $mail->Port = MAIL_PORT;               //Port TCP du serveur SMTP
    $mail->SMTPAuth = MAIL_SMTPAUTH;       //Utiliser l'identification

    if($mail->SMTPAuth){
        $mail->SMTPSecure = MAIL_SMTPSECURE;   //Protocole de sécurisation des échanges avec le SMTP
        $mail->Username   =  MAIL_USERNAME;    //Adresse email à utiliser
        $mail->Password   =  MAIL_PWD;         //Mot de passe de l'adresse email à utiliser
    }

    $mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères
    $mail->smtpConnect();

    $mail->From       =  MAIL_USERNAME;                //L'email à afficher pour l'envoi
    $mail->FromName   = 'Play and Learn Website';      //L'alias à afficher pour l'envoi

    $mail->Subject = $_POST['mail_subject'];
    $mail->MsgHTML($_POST['mail_content']); 		   //Le contenu au format HTML
    $mail->IsHTML(true);
    $mail->AddAddress(MAIL_USERNAME, "Play and Learn", "Entreprise");

    if (!$mail->send()) {
        $data['success'] = false;
        $data['message'] = array(
            "title" => "Erreur d'envoie du mail",
            "content"=> $mail->ErrorInfo
        );
    } else{
        $data['success'] = true;
    }
} catch (\Throwable $th) {
    $data['success'] = false;
    $data['message'] = array(
        "title" => "Erreur d'envoie du mail",
        "content"=> $th->getMessage()
    );
}

echo json_encode($data);

?>