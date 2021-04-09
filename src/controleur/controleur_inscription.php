<?php

function actionInscription($twig, $db) {
    $form = array();
    if (isset($_POST['btInscrire'])) {
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputPassword2 = $_POST['inputPassword2'];
        $nom = $_POST['inputNom'];
        $prenom = $_POST['inputPrenom'];
        $role = $_POST['role'];
        $departement = $_POST['departements'];
        $commune = $_POST['communes'];

        $form['valide'] = true;
        if ($inputPassword != $inputPassword2) {
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        } else {
            $unique = uniqid();
            $datejour = date("Y-m-d");
            $utilisateur = new Utilisateur($db);  //pr mettre en memoire la variable utilisateur
            $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $nom, $prenom, 0, $unique, $datejour, 0, $departement, $commune);  //on lui donne different parametre récupéré dans le formulaire (methode insert(définie dans la classe))
            if (!$exec) {   //si l'execution a échoué                        //password_hash pr hacher le mdp
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
            }
        }

        $form['email'] = $inputEmail;
        $form['role'] = $role;

        $email_b = 'n.lecherf@gmail.com';


        if (filter_var($email_b, FILTER_VALIDATE_EMAIL)) {
            echo "L'adresse email '$email_b' est considérée comme valide.";
        } else {
            echo "L'adresse email '$email_b' est considérée comme invalide.";
        }

        $adresse = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?page=validation&email=' . $form['email'] . '&unique=' . $unique;


        //email, lien unique (avc bon numero unique)
        // Le message

        $message ="
     <html>
      <body>
      <title>Bonjour {{ unUtilisateur.prenom }} {{ unUtilisateur.prenom }}</title>
       <br> Vous possedez un compte sur le site Devdev avec l'adresse email {{ unUtilisateur.email }} </br>
       <br> Il est important que vous validiez votre email. Sans cette validation, votre compte sera supprimé au bout de 24h </br>
       <br><a href= \"$adresse\" > Cliquez ici pour valider votre adresse mail </a></br>
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
        mail('n.lecherf@gmail.com', 'Validation adresse mail', $message, implode("\r\n", $headers));
    }




    echo $twig->render('inscription.html.twig', array('form' => $form));
}

?>