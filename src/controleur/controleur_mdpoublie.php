<?php

function actionMdpoublie($twig, $db) {
    $form = array();
    if (isset($_POST['btEnvoyer'])) {
        $unique = uniqid();
        $inputEmail = $_POST['inputEmail'];
        
        
         $form['valide'] = true;
        
        $form['email'] = $inputEmail;
        
        $email_b = 'n.lecherf@gmail.com';

       
            
            
        if (filter_var($email_b, FILTER_VALIDATE_EMAIL)) {
            echo "L'adresse email '$email_b' est considérée comme valide.";
        } else {
            echo "L'adresse email '$email_b' est considérée comme invalide.";
        }

        $adresse = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?page=reimdp&email=' . $form['email'] . '&unique=' . $unique;


        //email, lien unique (avc bon numero unique)
        // Le message

        $message ="
     <html>
      <body>
      <title>Bonjour,</title>
       <br> Vous nous avez demandé un lien de réinitialisation de votre mot de passe</br>
       <br> Le voici :</br>
       <br><a href= \"$adresse\" > Cliquez ici pour réinitialiser votre mot de passe </a></br>
       <br> Cordialement, </br>
       <br> L'équipe Devdev </br>
      </body>
     </html>
     ";

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';


//echo("email envoyé");  -> pr voir si mail c'est bel est bien envoyé
// Envoi du mail
        mail('n.lecherf@gmail.com', 'Réinitialisation mot de passe', $message, implode("\r\n", $headers));
    }




    echo $twig->render('mdpoublie.html.twig', array('form' => $form));
}

?>