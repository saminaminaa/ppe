<?php
function actionInscription($twig, $db){
    $form=array();
    if (isset($_POST['btInscrire'])){
         $inputEmail = $_POST['inputEmail'];
         $inputPassword = $_POST['inputPassword'];
         $inputPassword2 = $_POST['inputPassword2'];
         $nom = $_POST['inputNom'];
         $prenom = $_POST['inputPrenom'];
         $role = $_POST['role'];
         
          $form['valide'] = true;
    if ($inputPassword!=$inputPassword2){
         $form['valide'] = false;
         $form['message'] = 'Les mots de passe sont différents';
    }
    else{
        
        $utilisateur = new Utilisateur($db);  //pr mettre en memoire la variable utilisateur
        $idUnique = uniqid();
        $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $nom, $prenom, 'false', $idUnique);  //on lui donne different parametre récupéré dans le formulaire (methode insert(définie dans la classe))
        if (!$exec){   //si l'execution a échoué                        //password_hash pr hacher le mdp    false c pr dire qu'au debut l'email n'est pas encore valider
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
            }
            } 
         
         $form['email'] = $inputEmail;
         $form['role'] = $role;
    
        
         } 
    echo $twig->render('inscription.html.twig', array('form'=>$form)); 
}
?>