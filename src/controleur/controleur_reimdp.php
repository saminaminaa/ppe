<?php

function actionReimdp($twig, $db) {
    $form = array();
    var_dump($_GET);
    if (isset($_GET['email'])) { //on regarde dans la variable $_GET qui recupères tte les variables d1 lien si il a une clé qui se nomme "email"
        $utilisateur = new Utilisateur($db);
        //on cherche 1utilisateur dont on connait le mail:
        $unUtilisateur = $utilisateur->selectByEmail($_GET['email']);
        if ($unUtilisateur != null) {
            //si l'utilisateur existe :
            $form['utilisateur'] = $unUtilisateur; //on stock la variable "form" avc la clé "utilisateur"
            $role = new Role($db); //on instancie la class role (on la met en memoire)
            $liste = $role->select(); //methode select qui contient tout les roles
            $form['roles'] = $liste; //on met dans notre liste la variable "form" avec la clé "roles"
        } else {
            //si l'utilisateur n'existe pas
            $form['message'] = 'Utilisateur incorrect';
        }
    }


    if (isset($_POST['btEnvoyer'])) {
        $utilisateur = new Utilisateur($db);
        $form['utilisateur'] = $unUtilisateur;
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];
        if ($mdp != $mdp2) {
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        }else{
           
        $exec = $utilisateur->updateMdp($email, password_hash($mdp, PASSWORD_DEFAULT)); //modifier mdp
       
        if (!$exec) {
            $form['valide'] = false;
            $form['message'] = 'Échec de la modification';
        } else {
            $form['valide'] = true;
            $form['message'] = 'Modification réussie';
        }
        }
    }

    echo $twig->render('reimdp.html.twig', array('form' => $form));
}
?>


