<?php

function actionLangage($twig, $db){
    $type = new Langage($db);
    
    $form = array();
    
   
    
    if (isset($_POST['btAjouter'])){
         $inputLibelle = $_POST['inputLibelle'];
        
         
          $form['valide'] = true;
          $form['libelle']=$inputLibelle;
    
  
        $langage = new Langage($db);  //pr mettre en memoire la variable utilisateur
        $exec = $langage->insert($inputLibelle);  //on lui donne different parametre récupéré dans le formulaire (methode insert(définie dans la classe))
        if (!$exec){   //si l'execution a échoué                        //password_hash pr hacher le mdp
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table langage ';
            
        }
    }
    $liste = $langage -> select();
    echo $twig->render('langage.html.twig', array('form' => $form, 'liste' => $liste));
}

?>

