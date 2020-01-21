<?php

function actionProfil($twig, $db){
    $utilisateur = new Utilisateur($db); #instencier, pr pouvoir utiliser ce qu'on a mis dans la classe
    $unUtilisateur = $utilisateur->selectByEmail($_SESSION['login']); #recuperer qu'un seul utilisateur
    
    echo $twig->render('profil.html.twig', array('unUtilisateur'=> $unUtilisateur));
}
?>