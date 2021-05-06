<?php

function actionListeutilisateur($twig, $db){
    $utilisateur = new Utilisateur($db);
    
    

    //supprimer un utilisateur:
    if(isset($_GET['email'])){
        $exec=$utilisateur->delete($_GET['email']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table utilisateur';
        }
        else{
            $form['valide'] = true;
            $form['message'] = 'Utilisateur avec succès';
        }
    }
          
    $liste = $utilisateur -> select();
    echo $twig->render('listeutilisateur.html.twig', array('utilisateur'=> $utilisateur, 'liste' => $liste));
}

function actionUtilisateurWs($twig, $db){
    $utilisateur = new Utilisateur($db);
    $json = json_encode($liste = $utilisateur->select());
    echo $json;
}

?>

