<?php

function actionListeutilisateur($twig, $db){
    $utilisateur = new Utilisateur($db);
    
    $form = array();
    
   
    
    if (isset($_POST['btAjouter'])){
         $inputLibelle = $_POST['inputLibelle'];
        
         
          $form['valide'] = true;
          $form['libelle']=$inputLibelle;
    
  
        $type = new Type($db);  //pr mettre en memoire la variable utilisateur
        $exec = $type->insert($inputLibelle);  //on lui donne different parametre récupéré dans le formulaire (methode insert(définie dans la classe))
        if (!$exec){   //si l'execution a échoué                        //password_hash pr hacher le mdp
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
            
        }
    }
    $liste = $utilisateur -> select();
    echo $twig->render('listeutilisateur.html.twig', array('form' => $form, 'utilisateur' => $utilisateur));
}

?>

