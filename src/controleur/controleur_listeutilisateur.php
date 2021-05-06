<?php

function actionListeutilisateur($twig, $db){
    $utilisateur = new Utilisateur($db);
    
    $liste = $utilisateur -> select();
    echo $twig->render('listeutilisateur.html.twig', array('utilisateur'=> $utilisateur, 'liste' => $liste));
}

function actionUtilisateurWs($twig, $db){
    $utilisateur = new Utilisateur($db);
    $json = json_encode($liste = $utilisateur->select());
    echo $json;
}

?>

