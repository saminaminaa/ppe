<?php

function actionListeutilisateur($twig, $db){
    $utilisateur = new Utilisateur($db);
    
    $liste = $utilisateur -> select();
    echo $twig->render('listeutilisateur.html.twig', array('utilisateur'=> $utilisateur, 'liste' => $liste));
}

?>

