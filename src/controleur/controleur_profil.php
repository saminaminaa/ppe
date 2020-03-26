<?php

function actionProfil($twig, $db){
    $code = new Code($db);
    $utilisateur = new Utilisateur($db); #instencier, pr pouvoir utiliser ce qu'on a mis dans la classe
    $unUtilisateur = $utilisateur->selectByEmail($_SESSION['login']); #recuperer qu'un seul utilisateur
    
  //supprimer un langage en cochant:
      if(isset($_POST['btSupprimer'])){
          $cocher = $_POST['cocher'];
          $form['valide'] = true;
          foreach ( $cocher as $idLangage){
              $exec=$code->delete($idEmail, $idLangage);
              if (!$exec){
                  $form['valide'] = false;
                  $form['message'] = 'Problème de suppression dans la table code';             }        }    }
    
    $liste = $code -> select();
    echo $twig->render('profil.html.twig', array('unUtilisateur'=> $unUtilisateur, 'liste'=>$liste));
}
?>