<?php

function actionEquipe($twig, $db) {
    $form['valide'] = true;

    $type = new Equipe($db);
    $form = array();

    if(isset($_POST['btEquipe'])){
        $inputLibelle = $_POST['inputLibelle'];
        
        $form['valide'] = true;
        $form['libelle']=$inputLibelle;
    
        $equipe = new Equipe($db);
        $exec = $equipe->insert($inputLibelle); 
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table équipe ';
            
        }
    }

    echo $twig->render('equipe.html.twig', array("form"=>$form));
}

function actionListeEquipe($twig, $db){
    $equipe = new Equipe($db);
    
    $liste = $equipe -> select();
    echo $twig->render('listeequipe.html.twig', array('equipe'=> $equipe, 'liste' => $liste));
}

function actionModifEquipe($twig, $db){
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $utilisateurEquipe = new UtilisateurEquipe($db);
    
        $liste = $utilisateurEquipe -> selectByEquipe($id);
        echo $twig->render('modifequipe.html.twig', array('utilisateurEquipe'=> $utilisateurEquipe, 'liste' => $liste)); 
    }
}
?>