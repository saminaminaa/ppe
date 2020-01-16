<?php 
function getPage($db){
    
    $lesPages['accueil'] = "actionAccueil";
    $lesPages['connexion'] = "actionConnexion";
    $lesPages['inscription'] = "actionInscription";
    $lesPages['profil']="actionProfil";
    $lesPages['apropos']="actionApropos";
    $lesPages['validation']="actionValidation";
    
    if(isset($_GET['page'])){
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

