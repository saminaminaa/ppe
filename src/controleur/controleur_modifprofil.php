<?php
function actionModifprofil($twig, $db){
    $form = array();
    if(isset($_GET['email'])){ //on regarde dans la variable $_GET qui recupères tte les variables d1 lien si il a une clé qui se nomme "email"
        $utilisateur = new Utilisateur($db);
        //on cherche 1utilisateur dont on connait le mail:
        $unUtilisateur = $utilisateur->selectByEmail($_SESSION['login'], $_GET['email']);
        if ($unUtilisateur!=null){
            //si l'utilisateur existe :
            $form['utilisateur'] = $unUtilisateur; //on stock la variable "form" avc la clé "utilisateur"
             $role = new Role($db); //on instancie la class role (on la met en memoire)
             $liste = $role->select(); //methode select qui contient tout les roles
             $form['roles']=$liste; //on met dans notre liste la variable "form" avec la clé "roles"
        }
            else{
                //si l'utilisateur n'existe pas
                $form['message'] = 'Utilisateur incorrect';
                }
                }
                else{
                     if(isset($_POST['btModifier'])){
                         $utilisateur = new Utilisateur($db);
                         $nom = $_POST['nom'];
                         $prenom = $_POST['prenom'];
                         $role = $_POST['role'];
                         $email = $_POST['email'];
                         $mdp = $_POST['mdp'];
                         $exec=$utilisateur->update($email, $role, $nom, $prenom); //modifier nom/prenom/role
                         $exec=$utilisateur->updateMdp($email, password_hash($mdp, PASSWORD_DEFAULT)); //modifier mdp
                         empty($mdp);
                         if(!$exec){
                             $form['valide'] = false;
                         $form['message'] = 'Échec de la modification';
                         }
                         else{
                             $form['valide'] = true;
                             $form['message'] = 'Modification réussie';
                             }
                             }
                             else{
                    $form['message'] = 'Utilisateur non précisé';
                    }
                }
                    echo $twig->render('modifprofil.html.twig', array('form'=>$form));
                    }



    ?>
