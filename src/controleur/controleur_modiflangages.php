<?php
function actionModiflangages($twig, $db){
    $form=array();
    //var_dump($_SESSION); 
    // Si j'ai cliqué sur le bouton
    if (isset($_POST['btAjtLangages'])){
        // Je récupère les valeurs
       
         $idLangage = $_POST['idLangage'];
         
          $form['valide'] = true;
           $code = new Code($db);  //pr mettre en memoire la variable utilisateur
        $exec = $code->insert($_SESSION['login'], $idLangage);  //on lui donne different parametre récupéré dans le formulaire (methode insert(définie dans la classe))
        if (!$exec){   //si l'execution a échoué                        //$_SESSION['login'] pour recup l'email de la personne connecté
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table code ';
            }
        }
    
    else{
        // Si je n'ai pas cliqué sur le bouton
    }    
        if(isset($_POST['btSuprimer'])){
            $exec=$code->delete($_GET['id']);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème de suppression dans la table utilisateur';
                }
                else{
                    $form['valide'] = true;
                    $form['message'] = 'Langage supprimé avec succès';
                    }
                    }

         
    echo $twig->render('modif-langages.html.twig', array('form'=>$form)); 
}
?>
