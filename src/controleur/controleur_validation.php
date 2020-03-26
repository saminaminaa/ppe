<?php
    function actionValidation($twig, $db){
        
        // Récupération des variables nécessaires à l'activation
$email = $_GET['email'];
$unique = $_GET['unique'];
 

echo $email.' '.$unique;

$utilisateur = new Utilisateur($db); //instencie la classe
$unUtilisateur = $utilisateur ->selectByEmail($email); //on appel l'outil

    if ($unUtilisateur==null){
    
    echo'utilisateur incorrect'; }
    
    else {
    
    echo 'utilisateur correct';
    var_dump($unUtilisateur);
    if ($unUtilisateur['idUnique']== $unique) {
        echo'numero identique';
        $utilisateur ->updateValider($email);
    }
    else {
        echo'numero incorrect';
    }
    }
    
   

        echo $twig->render('validation.html.twig', array());
    }
?>