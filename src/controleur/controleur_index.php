<?php

function actionAccueil($twig, $db) {
    echo $twig->render('index.html.twig', array());
}

function actionApropos($twig) {
    echo $twig->render('apropos.html.twig', array());
}

function actionMentionlegales($twig) {
    echo $twig->render('mentionlegales.html.twig', array());
}

function actionConnexion($twig, $db) {
    $form = array();
    $form['valide'] = true;
    if (isset($_POST['btConnecter'])) {
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];


        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->connect($inputEmail);
        $date = date("Y-m-d");
        $exec = $utilisateur->updateDate($inputEmail, $date);
        if ($unUtilisateur != null) {
            //l'utilisateur existe
            if (!password_verify($inputPassword, $unUtilisateur['mdp'])) {
                //si le mdp n'est pas valide
                $form['valide'] = false;
                $form['message'] = "Login ou mot de passe incorrect";
            } else {
                //si le mdp est valide
                if ($unUtilisateur['valider'] == 1) {
                    //si l'email a bien été validé
                    $_SESSION['login'] = $inputEmail;
                    $_SESSION['role'] = $unUtilisateur['idRole'];
                    header("Location:index.php");
                } else {
                    //si le mdp n'est pas valide
                    $form['valide'] = false;
                    $form['message'] = "Votre email n'a pas été validé";
                }
            }
        } else {
            //si l'utilisateur n'existe pas
            $form['valide'] = false;
            $form['message'] = "Login ou mot de passe incorrect";
        }
    }
    echo $twig->render('connexion.html.twig', array('form' => $form));
}

function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig', array());
}

function actionDeconnexion($twig) {
    session_unset();
    session_destroy();
    header("Location:index.php");
}

?>