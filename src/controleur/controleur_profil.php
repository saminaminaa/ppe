<?php

function actionProfil($twig, $db){
    $code = new Code($db);
    $utilisateur = new Utilisateur($db); #instencier, pr pouvoir utiliser ce qu'on a mis dans la classe
    $unUtilisateur = $utilisateur->selectByEmail($_SESSION['login']); #recuperer qu'un seul utilisateur
    
    
    
    
    $liste = $code -> select();
    echo $twig->render('profil.html.twig', array('unUtilisateur'=> $unUtilisateur, 'liste'=>$liste));
}
?>