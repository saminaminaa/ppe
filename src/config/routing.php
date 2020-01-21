<?php 
function getPage($db){
    
    $lesPages['accueil'] = "actionAccueil";
    $lesPages['connexion'] = "actionConnexion";
    $lesPages['inscription'] = "actionInscription";
    $lesPages['profil']="actionProfil";
    $lesPages['apropos']="actionApropos";
    $lesPages['validation']="actionValidation";
    $lesPages['modifemail']="actionModifEmail";
    $lesPages['modifnom']="actionModifNom";
    $lesPages['modifmdp']="actionModifMdp";
    
    if(isset($_GET['page'])){  #pr ne pas tt afficher sur la page d'accueil
        $page = $_GET['page'];
        }
        else{
            $page = 'accueil';
            
    }
if (!isset($lesPages[$page]))
{
    $page = 'accueil';
    }
 $contenu = $lesPages[$page];
 return $contenu;
 } 
?>

